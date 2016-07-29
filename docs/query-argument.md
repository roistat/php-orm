# Query\Engine\MySQL\Argument

Arguments are basic MySQL engine entities. They implements `ObjectInterface`, `SingleValueInterface` or `MultiValueInterface`. So they all has method `prepare` without input parameters and some of them has methods `value` or `values` without input parameters too.

Here is list of all arguments:

 - [Alias](#alias)
 - [Any](#any)
 - [Asc](#asc)
 - [Column](#column)
 - [DefaultValue](#defaultvalue)
 - [Desc](#desc)
 - [Field](#field)
 - [NullValue](#nullvalue)
 - [Table](#table)
 - [Value](#value)

## Alias

This class creates object, which corresponds MySQL alias argument using in context like this:

```
`name` AS `alias`
```

It has one input parameter - name of alias, string type.

### Example

```php
$alias = new Argument\Alias("alias");
$alias->prepare(); // `alias`
```

## Any

Corresponds MySQL argument `*`, has no input parameters.

### Example

```php
$any = new Argument\Any();
$any->prepare(); // *
```

## Asc

Corresponds MySQL sorting in `ORDER` and `GROUP` clauses, has one input parameter, which should be instance of `Alias`, `Column` or `Table`.

### Example

```php
$asc = new Argument\Asc(new Argument\Column("id"));
$asc->prepare(); // ASC `id`
```

## Column

Corresponds MySQL column argument, has one input parameter - name of column, string type.

### Example

```php
$column = new Argument\Column("id");
$column->prepare(); // `id`
```

## Desc

Corresponds MySQL sorting in `ORDER` and `GROUP` clauses, has one input parameter, which should be instance of `Alias`, `Column` or `Table`.

### Example

```php
$desc = new Argument\Desc(new Argument\Column("id"));
$desc->prepare(); // DESC `id`
```

## DefaultValue

Corresponds MySQL `DEFAULT` value in `SET` or `VALUES` clauses of `UPDATE`, `INSERT` and `REPLACE` MySQL statements. Has no input parameters.

### Example

```php
$defaultValue = new Argument\DefaultValue();
$defaultValue->prepare(); // DEFAULT
```

## Field

Corresponds MySQL field object for `SELECT` statement, has two input parameters:

 - expression - any instance of `ObjectInterface`, for example, column or any function (instance of any class from namespace `Query\Engine\MySQL\Func`).
 - alias - `Alias` object, optional parameter.

### Example 1

```php
$field = new Argument\Field(
	new Argument\Column("user_id"),
	new Argument\Alias("uid")
);
$field->prepare(); // `user_id` AS `uid`
```

### Example 2

```php
$field = new Argument\Field(
	new Func\Count(new Argument\Column("id")),
	new Argument\Alias("num")
);
$field->prepare(); // COUNT(`id`) AS `num`
```

## NullValue

Corresponds MySQL `NULL` value, has no input parameters.

### Example

```php
$nullValue = new Argument\NullValue();
$nullValue->prepare(); // NULL
```

## Table

Corresponds MySQL table adentifier, has one input parameter - table name, string type.

### Example

```php
$table = new Argument\Table("table");
$table->prepare(); // `table`
```

## Value

Corresponds MySQL values, in prepared statement it displays as `?`, for getting actual value you can use `value` method. It has one input parameter - int, double, string or boolean type.

### Example

```php
$value = new Argument\Value(123);
$value->prepare(); // ?
$value->value(); // 123
```
