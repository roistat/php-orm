# Builder

Namespace: `RsORM\Query\Engine\MySQL\Builder`

It is special class, which realizes abstract layer for other classes in query package and build different MySQL statements. This class has methods, which are aliases for `MySQL\Builder\*` classes and aliases for some other classes in `MySQL` namespace. All methods of `Builder` class can be divided:

 - [filter](#filter)
 - [Statements](#statements)
 - [MySQL functions](#mysql-functions)

## filter

It is special builder for creating different MySQL conditions and logical expressions. Each method of this class has various number of input parameters, but last of them is boolean not-flag. This rule doesn't work only for method `logicOr`. What does it mean? There are no methods like `notEq`, `notIsNull`, `notLike` and so on. You can create appropriate expression with this last input parameter (not-flag). All methods create parts of common logical expression, and these parts combine with `AND` operator, except method `logicOr`.

```php
$filter = MySQl\Builder::filter()
	->eq("id", 123) // `id` = 123
	->eq("id", 321, false) // `id` != 321
	->like("name", "%asd%") // `name` LIKE '%asd%'
	->like("name", "%qwe%", false) // NOT(`name` LIKE '%qwe%')
	->lt("age", 18) // `age` < 18
	->gt("age", 18) // `age` > 18
	->lte("age", 18) // `age` <= 18
	->gte("age", 18) // `age` >= 18
	->in("id", [1, 2, 3]) // `id` IN (1, 2, 3)
	->between("id", 100, 200) // `id` BETWEEN 100 AND 200
	->is("flag", true) // `id` IS TRUE
	->isNull("id") // `id` IS NULL
	// Compare method 
	->compare("id", 1) // `id` = 1
	->compare("flag", null) // `flag` IS NULL
```

`compare` method in example combines `eq`, `like`, `is`, `isNull`, `in` methods by checking type of input parameters. It is only abstract layer for these methods. It has last input parameter (not-flag) too.

`LogicOr` method on the other hand add part of logical expression with `OR` operator. It has only one input parameter, instance of class `Builder\Filter`.

```php
$orFilter = MySQL\Builder::filter()
	->gt("id", 200);
$filter = MySQL\Builder::filter()
	->lt("id", 100)
	->logicOr($orFilter);
$statement = $filter->build();
$statement->prepare(); // (`id` < ?) OR (`id` > ?)
$statement->values(); // [100, 200]
```

## Statements

Builder statement methods return `Builder\*` objects for appropriate MySQL statements. Here you can see list of this methods:

 - [select](#select)
 - [delete](#delete)
 - [insert](#insert)
 - [replace](#replace)
 - [update](#update)

Each of returned builder objects has some required and optional methods for combining statement. Some of these methods common for several statements, some of them - unique. Whole list of them you can see [here](#statement-methods).

### select

This static method returns `Builder\Select` object and may be without any input parameters. In this case result statement looks like this: `SELECT * ...`. In common case this method has one input parameter (optional) - array of fields or any MySQL objects.

`Builder\Select` object has methods:

 - [table](#table)
 - [where](#where)
 - [group](#group)
 - [having](#having)
 - [order](#order)
 - [limit](#limit)
 - [flag methods](#flag-methods)

Bellow you can see the most simple example of usage:

```php
$statement = MySQL\Builder::select()
	->table("table")
	->build();
$statement->prepare(); // SELECT * FROM `table`
```

Bellow you can see 3 useful examples for select statement:

```php
// SELECT * ...
$statement = MySQL\Builder::select();

// SELECT CONCAT('qwe', 'rty')
$statement = MySQL\Builder::select([
	Builder::funcConcat([
		new Argument\Value("qwe"),
		new Argument\Value("rty")
	])
]);

// SELECT `id`, `group_id` AS `gid`, COUNT(DISTINCT `id`) AS `num` FROM `table`
$statement = MySQL\Builder::select([
	"id",
	new Argument\Field(
		new Argument\Column("group_id"),
		new Argument\Alias("gid")
	),
	Builder::funcCount("id", "num", true)
]);
```

### delete

Returns `Builder\Delete` object, has no input parameters. `Builder\Delete` object has methods:

 - [table](#table) (required)
 - [where](#where)
 - [order](#order)
 - [limit](#limit)
 - [Flag methods](#flag-methods)

Bellow you can see simple example:

```php
$statement = MySQL\Builder::delete()
	->table("table")
	->build();
$statement->prepare(); // DELETE FROM `table`
```

### insert

Returns `Builder\Insert` object, has one input parameter - key-value array of inserting data, where key - DB table column. `Builder\Insert` object has methods:

 - [table](#table) (required)
 - [Flag methods](#flag-methods)

```php
$statement = MySQL\Builder::insert([
	"id" => 1,
	"field" => "value",
])->table("table")->build();
$statement->prepare(); // INSERT INTO `table` (`id`, `field`) VALUES (?, ?)
$statement->values(); // [1, "value"]
```

### replace

Returns `Builder\Replace` object, has one input parameter - key-value array of replacing data, where key - DB table column. `Builder\Replace` object has methods:

 - [table](#table) (required)
 - [Flag methods](#flag-methods)

```php
$statement = MySQL\Builder::replace([
	"id" => 1,
	"field" => "value",
])->table("table")->build();
$statement->prepare(); // REPLACE INTO `table` (`id`, `field`) VALUES (?, ?)
$statement->values(); // [1, "value"]
```

### update

Returns `Builder\Update` object, has one input parameter - key-value array of updating data, where key - DB table column. `Builder\Update` object has methods:

 - [table](#table) (required)
 - [where](#where)
 - [order](#order)
 - [limit](#limit)
 - [Flag methods](#flag-methods)

```php
$statement = MySQL\Builder::update([
	"field1" => "value1",
	"field2" => "value2"
])->table("table")->build();
$statement->prepare(); // UPDATE `table` SET `field1` = ?, `field2` = ?
$statement->values(); // ["value1", "value2"]
```

### Statement methods

 - group
 - having
 - limit
 - order
 - table
 - where
 - Flag methods

#### group

Set grouping for `GROUP` MySQL clause. Has two input parameters:

 - name - name of column (string);
 - asc - sorting type, optional parameter, default value - true.

Each new call of this method add new grouping.

```php
$statement->group("id"); // GROUP `id`
$statement->group("gid", false); // GROUP `id`, `gid` DESC
```

#### having

Set condition for `HAVING` MySQL clause. Has one input parameter: filter - `Builder\Filter` object.

```php
$filter = Builder::filter()
	->eq("id", 123);
$statement->having($filter); // HAVING `id` = 123
```

#### limit

Set limit values for `LIMIT` MySQL clause. Has two input parameters:

 - offset - offset value;
 - count - number of rows affected by MySQL query, optional parameter.

```php
$statement->limit(10, 20); // LIMIT 10, 20
$statement->limit(10); // LIMIT 10
```

#### order

Set ordering for `ORDER` MySQL clause. Has two input parameters:

 - name - name of column (string);
 - asc - sorting type, optional parameter, default value - true.

Each new call of this method add new ordering.

```php
$statement->order("id"); // ORDER `id`
$statement->order("gid", false); // ORDER `id`, `gid` DESC
```

#### table

Set table name for `FROM`, `INTO` MySQL clause and `UPDATE` MySQL statement. Has one input parameter: name - table name (string).

```php
$statement = Builder::select()
	->table("table");
// SELECT * FROM `table`

$statement = Builder::insert(...) // or replace
	->table("table");
// INSERT INTO `table` ...

$statement = Builder::update(...)
	->table("table");
// UPDATE `table` ...

$statement = Builder::delete()
	->table("table");
// DELETE FROM `table`
```

#### where

Set condition for `WHERE` MySQL clause. Has one input parameter: filter - `Builder\Filter` object.

```php
$filter = Builder::filter()
	->eq("id", 123);
$statement->where($filter); // WHERE `id` = 123
```

#### Flag methods

Flag methods has no input parameters. Each new call of any flag method add new flag to MySQL statement.

 - flagAll
 - flagDelayed
 - flagDistinct
 - flagDistinctRow
 - flagHighPriority
 - flagIgnore
 - flagLowPriority
 - flagQuick
 - flagSQLBigResult
 - flagSQLBufferResult
 - flagSQLCache
 - flagSQLCalcFoundRows
 - flagSQLNoCache
 - flagSQLSmallResult
 - flagStraightJoin

```php
$statement = Builder::select()
	->table("table")
	->flagHighPriority()
	->build();
$statement->prepare(); // SELECT HIGH_PRIORITY * FROM `table`
```

## MySQL functions

 - [funcCount](#funccount)
 - [funcAvg](#funcavg)
 - [funcSum](#funcsum)
 - [funcConcat](#funcconcat)

`Builder::func*` static methods realize abstract layer for `MySQL\Func\*` objects. `funcCount`, `funcAvg`, `funcSum` has common input parameters:

 - columnName - column name (string);
 - aliasName - alias name (string);
 - distinct - distinct flag (boolean), optional parameter, default value: false.

### funcCount

```php
$statement = Builder::funcCount("id", "num", true);
$statement->prepare(); // COUNT(DISTINCT `id`) AS `num`
```

### funcAvg

```php
$statement = Builder::funcAvg("val", "average", true);
$statement->prepare(); // AVG(DISTINCT `val`) AS `average`
```

### funcSum

```php
$statement = Builder::funcSum("val", "sum", true);
$statement->prepare(); // SUM(DISTINCT `val`) AS `sum`
```

### funcConcat

This static method is alias for `MySQL\Func\Concat` object and has two input parameters:

 - arguments - array of strings;
 - aliasName - alias name (string).

```php
$statement = Builder::funcConcat(["qwe", "asd"], "str");
$statement->prepare(); // CONCAT(?, ?) AS `str`
$statement->values(); // ["qwe", "asd"]
```
