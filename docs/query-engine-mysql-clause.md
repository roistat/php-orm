# Query\Engine\MySQL\Clause

## Classes

These classes corresponds to MySQL clauses, like `FROM ...`, `WHERE ...`, `GROUP BY ...` and so on. They extends `MySQSL\MultiValueInterface` and has `prepare` and `values` methods.

 - [**Fields**](#fields)
 - [**Filter**](#filter)
 - [**Flags**](#flags)
 - [**From**](#from)
 - [**Group**](#group)
 - [**Having**](#having)
 - [**Into**](#into)
 - [**Limit**](#limit)
 - [**Objects**](#objects)
 - [**Order**](#order)
 - [**Set**](#set)
 - [**Target**](#target)
 - [**Values**](#values)

### Fields

```php
__construct(Argument\Field[] $fields)
```

#### Parameters

*fields* - set of fields for insert statement.

#### Example

```php
$fields = new Clause\Fields([
	new Argument\Field(new Argument\Column("id")),
	new Argument\Field(new Argument\Column("name")),
]);
$fields->prepare(); // (`id`, `name`)
$fields->values(); // []
```

### Filter

```php
__construct(MySQL\ObjectInterface $condition)
```

#### Parameters

*condition* - `MySQL\ObjectInterface` object, compilation of different conditions (`MySQL\Condition\*`).

#### Example

```php
$condition = new Condition\Equal(
	new Argument\Column("id"),
	new Argument\Value(123)
);
$filter = new Clause\Filter($condition);
$filter->prepare(); // WHERE `id` = ?
$filter->values(); // [123]
```

### Flags

```php
__construct(Flag\AbstractFlag[] $flags)
```

#### Parameters

*flags* - set of flags, which are situated in the beginning of MySQL statement straightly after statement keyword such as `SELECT`, `DELETE` and so on. For example, `HIGH_PRIORITY`.

#### Example

```php
$flags = new Clause\Flags([
	new Flag\HighPriority(),
	new Flag\Quick(),
]);
$flags->prepare(); // HIGH_PRIORITY QUICK
$flags->values(); // []
```

### From

```php
__construct(Argument\Table $table)
```

#### Parameters

*table* - table name for `FROM` clause of MySQL statement.

#### Example

```php
$from = new Clause\From(
	new Argument\Table("table");
);
$from->prepare(); // FROM `table`
$from->values(); // []
```

### Group

```php
__construct(MySQL\ObjectInterface $arguments)
```

#### Parameters

*arguments* - set of columns, aliases, any other objects.

#### Example

```php
$group = new Group([
	new Argument\Column("pos"),
	new Argument\Desc("pos2"),
]);
$group->prepare(); // GROUP BY `pos`, `pos2` DESC
$group->values(); // []
```

### Having

```php
__construct(MySQL\ObjectInterface $condition)
```

#### Parameters

*condition* - `MySQL\ObjectInterface` object, compilation of different conditions (`MySQL\Condition\*`).

#### Example

```php
$condition = new Condition\Equal(
	new Argument\Column("id"),
	new Argument\Value(123)
);
$filter = new Clause\Having($condition);
$filter->prepare(); // HAVING `id` = ?
$filter->values(); // [123]
```

### Into

```php
__construct(Argument\Table $table)
```

#### Parameters

*table* - table name for `INTO` clause of MySQL statement.

#### Example

```php
$into = new Clause\Into(
	new Argument\Table("table");
);
$into->prepare(); // INTO `table`
$into->values(); // []
```

### Limit

```php
__construct(
	Argument\Value $offset,
	Argument\Value $count = null)
```

#### Parameters

*offset* - `Argument\Value` object, corresponds to the offset in MySQL clause `LIMIT`.

*count* - `Argument\Value` object, corresponds to the count in MySQL clause `LIMIT`. Optional parameter.

#### Example

```php
$limit = new Clause\Limit(
	new Argument\Value(10),
	new Argument\Value(20),
);
$limit->prepare(); // LIMIT 10, 20
$limit->values(); // [10, 20]
```

### Objects

```php
__construct(MySQL\ObjectInterface[] $arguments)
```

#### Parameters

*arguments* - array of `MySQL\ObjectInterface` objects corresponds to columns, aliases, functions and so on.

#### Examples

##### Example 1 Common case

```php
$objects = new Clause\Objects([
	new Argument\Column("id"),
	new Argument\Field(
		new Argument\Column("name2"),
		new Argument\Alias("last_name")),
	new Argument\Field(
		new Func\Count("id", true),
		new Argument\Alias("num")),
]);
$objects->prepare(); // `id`, `name2` AS `last_name`, COUNT(DISTINCT `id`) AS `num`
$objects->values(); // []
```

##### Example 2 Select all case

```php
$objects = new Clause\Objects([
	new Argument\Any(),
]);
$objects->prepare(); // *
$objects->values(); // []
```

### Order

```php
__construct(MySQL\ObjectInterface $arguments)
```

#### Parameters

*arguments* - set of columns, aliases, any other objects.

#### Example

```php
$order = new Clause\Order([
	new Argument\Column("pos"),
	new Argument\Desc("pos2"),
]);
$order->prepare(); // ORDER BY `pos`, `pos2` DESC
$order->values(); // []
```

### Set

```php
__construct(Operator\Assign[] $values)
```

#### Parameters

*values* - array of `Operator\Assign` objects.

#### Example

```php
$set = new Clause\Set([
	new Operator\Set(
		new Argument\Column("id"),
		new Argument\Value(123)),
	new Operator\Set(
		new Argument\Column("name"),
		new Argument\Value("Mike")),
]);
$set->prepare(); // `id` = ?, `name` = ?
$set->values(); // [123, "Mike"]
```

### Target

```php
__construct(Argument\Table $table)
```

#### Parameters

*table* - table name for table identification in clause of MySQL update statement.

#### Example

```php
$target = new Clause\Target(
	new Argument\Table("table");
);
$target->prepare(); // `table`
$target->values(); // []
```

### Values

```php
__construct(MySQL\ObjectInterface[] $arguments)
```

#### Parameters

*arguments* - array of `MySQL\ObjectInterface` objects corresponds to different type of values or MySQL expressions.

#### Examples

```php
$values = new Clause\Values([
	new Argument\Value(123),
	new Argument\NullValue(),
	new Argument\DefaultValue(),
]);
$values->prepare(); // (?, NULL, DEFAULT)
$values->values(); // [123]
```
