# Clause

Namespace: `RsORM\Query\Engine\MySQL\Clause`

Clause is a part of SQL-statement. It builds from arguments, operators, conditions, SQL-expressions. All clauses implement `MultiValueInterface`.

## Examples

```php
// Objects
$fields = new Clause\Objects([
	new Argument\Field(new Argument\Column("id")),
	new Argument\Field(new Argument\Column("name")),
]);
$fields->prepare(); // `id`, `name`
$fields->values(); // []

// Fields
$fields = new Clause\Fields([
	new Argument\Field(new Argument\Column("id")),
	new Argument\Field(new Argument\Column("name")),
]);
$fields->prepare(); // (`id`, `name`)
$fields->values(); // []

// From
$target = new Clause\From(new Argument\Table("table"));
$target->prepare(); // FROM `table`
$target->values(); // []

// Into
$target = new Clause\Into(new Argument\Table("table"));
$target->prepare(); // INTO `table`
$target->values(); // []

// Target
$target = new Clause\Target(new Argument\Table("table"));
$target->prepare(); // `table`
$target->values(); // []

// Filter
$filter = new Clause\Filter(
	new Condition\And([
		new Condition\Equal(
			new Argument\Column("id"),
			new Argument\Value(123);
		),
		new Condition\Equal(
			new Argument\Column("alive"),
			new Argument\Value(1);
		)
	])
);
$filter->prepare(); // WHERE `id` = ? AND `alive` = ?
$filter->values(); // [123, 1]

// Having
$having = new Clause\Having(
	new Condition\And([
		new Condition\Equal(
			new Argument\Column("id"),
			new Argument\Value(123);
		),
		new Condition\Equal(
			new Argument\Column("alive"),
			new Argument\Value(1);
		)
	])
);
$having->prepare(); // HAVING `id` = ? AND `alive` = ?
$having->values(); // [123, 1]

// Set
$set = new Clause\Set([
	new Operator\Assign(
		new Argument\Column("id"),
		new Argument\Value(123)
	),
	new Operator\Assign(
		new Argument\Column("name"),
		new Argument\Value("Mike")
	)
]);
$set->prepare(); // SET `id` = ?, `name` = ?
$set->values(); // [123, "Mike"]

// Values
$values = new Clause\Values([
	new Argument\Value(123),
	new Argument\Value("Mike")
]);
$values->prepare(); // VALUES (?, ?)
$values->values(); // [123, "Mike"]

// Group
$group = new Clause\Group([
	new Argument\Column("id"),
	new Argument\Column("name")
]);
$group->prepare(); // GROUP BY `id`, `name`
$group->values(); // []

// Order
$order = new Clause\Order([
	new Argument\Asc(new Argument\Column("id")),
	new Argument\Desc(new Argument\Column("name"))
]);
$order->prepare(); // ORDER BY `id` ASC, `name` DESC
$order->values(); // []

// Limit
$limit = new Clause\Limit(
	new Argument\Value(5),
	new Argument\Value(10)
);
$limit->prepare(); // LIMIT ?, ?
$limit->values(); // [5, 10]

// Flags
$flags = new Clause\Flags([
	new Flag\Ignore(),
	new Flag\SQLNoCache(),
]);
$flags->prepare(); // IGNORE SQL_NO_CACHE
```