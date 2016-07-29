# Statement

Namespace: `RsORM\Query\Engine\MySQL\Statement`

SQL statements implement `MultiValueInterface` and are built from `MySQL\Clause` objects.

```php
Select::__construct(
	Clause\Objects $fields,
	Clause\From $table = null,
	Clause\Filter $filter = null,
	Clause\Group $group = null,
	Clause\Having $having = null,
	Clause\Order $order = null,
	Clause\Limit $limit = null,
	Clause\Flags $flags = null
);
```

 - `$fields` - set of fields for Select statement, required parameter
 - `$table` - target table, optional parameter
 - `$filter` - condition for select statement
 - `$group` - grouping
 - `$having` - having condition
 - `$order` - ordering (it can be asc or desc, asc by default)
 - `$limit` - limiting
 - `$flags` - flags in the beginning of the statement

```php
Delete::__construct(
	Clause\From $table,
	Clause\Filter $filter = null,
	Clause\Order $order = null,
	Clause\Limit $limit = null,
	Clause\Flags $flags = null
);
```

 - `$table` - required parameter
 - `$filter`, `$order`, `$limit`, `$flags` - are the same as in select statement

```php
Insert::__construct(
	Clause\Into $table,
	Clause\Values $values,
	Clause\Fields $fields = null,
	Clause\Flags $flags = null
);
```

 - `$table` - required parameter
 - `$values` - required parameter, set values
 - `$fields` - optional parameter, set of inserted fields
 - `$flags` - flags in the beginning of the statement

```php
Update::__construct(
	Clause\Target $table,
	Clause\Set $set,
	Clause\Filter $filter = null,
	Clause\Order $order = null,
	Clause\Limit $limit = null,
	Clause\Flags $flags = null
);
```

 - `$table` - required parameter
 - `$set` - also required parameter, set of key-value
 - `$filter`, `$order`, `$limit`, `$flags` - are the same as in select statement

## Examples

```php
// Select
$fields = new Clause\Objects([
	new Argument\Field(new Argument\Column("id")),
	new Argument\Field(new Argument\Column("name")),
]);
$table = new Clause\From(new Argument\Table("table"));
$filter = new Clause\Filter(new Condition\LogicalOr([
	new Condition\Equal(
		new Argument\Column("id"),
		new Argument\Value(10)),
	new Condition\Equal(
		new Argument\Column("id"),
		new Argument\Value(20)
	),
]));
$group = new Clause\Group([new Argument\Column("id")]);
$having = new Clause\Having(
	new Condition\Equal(
		new Argument\Column("alive"),
		new Argument\Value(true)
	)
);
$order = new Clause\Order([new Argument\Desc(new Argument\Column("id"))]);
$limit = new Clause\Limit(new Argument\Value(5), new Argument\Value(10));
$flags = new Clause\Flags([
	new Flag\Distinct(),
	new Flag\HighPriority(),
	new Flag\SQLNoCache(),
]);
$stmt = new Statement\Select($fields, $table, $filter, $group, $having, $order, $limit);
$stmt->prepare(); // SELECT DISTINCT HIGH_PRIORITY SQL_NO_CACHE `id`, `name` FROM `table` WHERE (`id` = ?) OR (`id` = ?) GROUP BY `id` HAVING `alive` = ? ORDER BY `id` DESC LIMIT ?, ?
$stmt->values(); // [10, 20, 1, 5, 10]

// Delete
$table = new Clause\From(new Argument\Table("table"));
$filter = new Clause\Filter(new Condition\LogicalOr([
	new Condition\Equal(new Argument\Column("id"), new Argument\Value(10)),
	new Condition\Equal(new Argument\Column("id"), new Argument\Value(20)),
]));
$order = new Clause\Order([new Argument\Desc(new Argument\Column("id"))]);
$limit = new Clause\Limit(new Argument\Value(5), new Argument\Value(10));
$flags = new Clause\Flags([
	new Flag\LowPriority(),
	new Flag\Quick(),
	new Flag\Ignore(),
]);
$stmt = new Statement\Delete($table, $filter, $order, $limit);
$stmt->prepare(); // DELETE LOW_PRIORITY QUICK IGNORE FROM `table` WHERE (`id` = ?) OR (`id` = ?) ORDER BY `id` DESC LIMIT ?, ?
$stmt->values(); // [10, 20, 5, 10]

// Insert
$fields = new Clause\Fields([
	new Argument\Column("id"),
	new Argument\Column("name"),
	new Argument\Column("qwe"),
]);
$table = new Clause\Into(new Argument\Table("table"));
$values = new Clause\Values([
	new Argument\Value(1),
	new Argument\Value("Mike"),
	new Argument\NullValue(),
]);
$flags = new Clause\Flags([
	new Flag\Delayed(),
	new Flag\Ignore(),
]);
$stmt = new Statement\Insert($table, $values, $fields);
$stmt->prepare(); // INSERT DELAYED IGNORE INTO `table` (`id`, `name`, `qwe`) VALUES (?, ?, NULL)
$stmt->values(); // [1, "Mike"]

// Update
$table = new Clause\Target(new Argument\Table("table"));
$set = new Clause\Set([
	new Operator\Assign(new Argument\Column("id"), new Argument\Value(1)),
	new Operator\Assign(new Argument\Column("name"), new Argument\Value("Mike")),
	new Operator\Assign(new Argument\Column("qwerty"), new Argument\NullValue()),
]);
$filter = new Clause\Filter(new Condition\LogicalOr([
	new Condition\Equal(new Argument\Column("id"), new Argument\Value(10)),
	new Condition\Equal(new Argument\Column("id"), new Argument\Value(20)),
]));
$order = new Clause\Order([new Argument\Desc(new Argument\Column("id"))]);
$limit = new Clause\Limit(new Argument\Value(5), new Argument\Value(10));
$flags = new Clause\Flags([
	new Flag\LowPriority(),
	new Flag\Ignore(),
]);
$stmt = new Statement\Update($table, $set, $filter, $order, $limit);
$stmt->prepare(); // "UPDATE LOW_PRIORITY IGNORE `table` SET `id` = ?, `name` = ?, `qwerty` = NULL WHERE (`id` = ?) OR (`id` = ?) ORDER BY `id` DESC LIMIT ?, ?
$stmt->values(); // [1, "Mike", 10, 20, 5, 10]
```
