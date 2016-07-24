# Query\Engine\MySQL\Statement

## Classes

[**Select**](#select)  
[**Delete**](#delete)  
[**Insert**](#insert)  
[**Replace**](#replace)  
[**Update**](#update)  

### Select

Class `Select` corresponds MySQL select statement. Create statement from clauses (some of them optional). It extends `MultiValueInterface`.

```php
__construct(
	Clause\Objects $objects,
	Clause\From $table = null,
	Clause\Filter $filter = null,
	Clause\Group $group = null,
	Clause\Having $having = null,
	Clause\Order $order = null,
	Clause\Limit $limit = null,
	Clause\Flags $flags = null)
```

#### Parameters

*objects* - `Clause\Objects` object. Set of columns, fields, functions, any other MySQL objects, that allowed in MySQL select statement.

*table* - `Clause\From` object. Table, table with alias. Optional parameter.

*filter* - `Clause\Filter` object. It is formed by different combinations of `MySQL\Condition` objects. It corresponds MySQL `WHERE` clause. Optional parameter.

*group* - `Clause\Group` object. Set of columns, aliases for `GROUP BY` clause. Optional parameter.

*having* - `Clause\Having` object. It is formed by different combinations of `MySQL\Condition` objects. It corresponds MySQL `HAVING` clause. Optional parameter.

*order* - `Clause\Order` object, corresponds MySQL `ORDER BY` clause. This parameter is set of columns or aliases for sorting result of query. Optional parameter.

*limit* - `Clause\Limit` object, corresponds MySQL `LIMIT` clause. This parameter set offset and number of rows for result of query. Optional parameter.

*flags* - `Clause\Flags` object, corresponds different flags straight after keyword `SELECT` (for example, `HIGH_PRIORITY`). Optional parameter.

#### Return value

Returns `Select` object, formed by input parameters (clauses).

#### Example

```php
$condition = new Condition\Equal(
	new Argument\Column("id"),
	new Argument\Value(123)
);
$statement = new Statement\Select(
	new Clause\Objects([new Argument\Any()]), // *
	new Clause\From(new Argument\Table("users")), // FROM `users`
	new Clause\Filter($condition), // WHERE `id` = ?
	new Clause\Group([new Argument\Column("pos")]), // GROUP BY `pos`
	new Clause\Having($condition), // HAVING `id` = ?
	new Clause\Order([new Argument\Column("pos")]), // ORDER BY `pos`
	new Clause\Limit(new Argument\Value(10), new Argument\Value(20)), // LIMIT ?, ?
	new Clause\Flags([new Flag\HighPriority()]) // HIGH_PRIORITY
);
$statement->prepare(); // SELECT HIGH_PRIORITY * FROM `users` WHERE `id` = ? GROUP BY `pos` HAVING `id` = ? ORDER BY `pos` LIMIT ?, ?
$statement->values(); // [123, 123, 10, 20]
```

### Delete

Class `Delete` corresponds MySQL delete statement. Create statement from clauses (some of them optional). It extends `MultiValueInterface`.

```php
__construct(
	Clause\From $table,
	Clause\Filter $filter = null,
	Clause\Order $order = null,
	Clause\Limit $limit = null,
	Clause\Flags $flags = null)
```

#### Parameters

*table* - `Clause\From` object. Table, table with alias. Optional parameter.

*filter* - `Clause\Filter` object. It is formed by different combinations of MySQL\Condition objects. It corresponds MySQL `WHERE` clause. Optional parameter.

*order* - `Clause\Order` object, corresponds MySQL `ORDER BY` clause. This parameter is set of columns or aliases for sorting result of query. Optional parameter.

*limit* - `Clause\Limit` object, corresponds MySQL `LIMIT` clause. This parameter set offset and number of rows for result of query. Optional parameter.

*flags* - `Clause\Flags` object, corresponds different flags straight after keyword `DELETE` (for example, `HIGH_PRIORITY`). Optional parameter.

#### Return value

Returns `Delete` object, formed by input parameters (clauses).

### Insert

Class `Insert` corresponds MySQL insert statement. Create statement from clauses (some of them optional). It extends `MultiValueInterface`.

```php
__construct(
	Clause\Into $table,
	Clause\Values $values,
	Clause\Fields $fields = null,
	Clause\Flags $flags = null)
```

#### Parameters

*table* - `Clause\Into` object. Table, table with alias. Optional parameter.

*values* - `Clause\Values` object, set of inserting row`s values.

*fields* - `Clause\Fields` object, set of inserting row`s fields.

*flags* - `Clause\Flags` object, corresponds different flags straight after keyword `INSERT` (for example, `HIGH_PRIORITY`). Optional parameter.

#### Return value

Returns `Insert` object, formed by input parameters (clauses).

### Replace

Class `Replace` corresponds MySQL replace statement. Create statement from clauses (some of them optional). It extends `MultiValueInterface`.

```php
__construct(
	Clause\Into $table,
	Clause\Values $values,
	Clause\Fields $fields = null,
	Clause\Flags $flags = null)
```

#### Parameters

*table* - `Clause\Into` object. Table, table with alias. Optional parameter.

*values* - `Clause\Values` object, set of replacing row`s values.

*fields* - `Clause\Fields` object, set of replacing row`s fields.

*flags* - `Clause\Flags` object, corresponds different flags straight after keyword `REPLACE` (for example, `HIGH_PRIORITY`). Optional parameter.

#### Return value

Returns `Replace` object, formed by input parameters (clauses).

### Update

Class `Update` corresponds MySQL update statement. Create statement from clauses (some of them optional). It extends `MultiValueInterface`.

```php
__construct(
	Clause\Target $table,
	Clause\Set $set,
	Clause\Filter $filter = null,
	Clause\Order $order = null,
	Clause\Limit $limit = null,
	Clause\Flags $flags = null)
```

#### Parameters

*table* - `Clause\Target` object. Table, table with alias. Optional parameter.

*set* - `Clause\Set` object. Set of updating row`s values in form of key-value array.

*filter* - `Clause\Filter` object. It is formed by different combinations of `MySQL\Condition` objects. It corresponds MySQL `WHERE` clause. Optional parameter.

*order* - `Clause\Order` object, corresponds MySQL `ORDER BY` clause. This parameter is set of columns or aliases for sorting result of query. Optional parameter.

*limit* - `Clause\Limit` object, corresponds MySQL `LIMIT` clause. This parameter set offset and number of rows for result of query. Optional parameter.

*flags* - `Clause\Flags` object, corresponds different flags straight after keyword `REPLACE` (for example, `HIGH_PRIORITY`). Optional parameter.

#### Return value

Returns `Update` object, formed by input parameters (clauses).
