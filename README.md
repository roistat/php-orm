# RsORM

Simple and fast DB utils with no magic methods. It could be used in high load projects even with partitioning and sharding. 

* State package — responsible for object state management. Returns the data that prepared for usage in DB queries.
* Query package — responsible for creating queries from ORM data to specified DB engine. 


## State

All entities should be extended from RsORM\State\Entity which encapsulates object state data and get/set methods. All actions are going in RsORM\State\Engine.
Engine has several methods: isNew, isChanged, diff. Diff method returns array of changed fields with values.

### Examples:

```php
<?php

class Project extends State\Entity {
    public $id;
    public $name;
    public $user_id;
}
$engine = new State\Engine();

// You could create objects as usual
$project = new Project();

// New objects it's object without initial state
$isNew = $engine->isNew($project); // true
$isChanged = $engine->isChanged($project); // false

$project->name = "Test";
$project->user_id = 1;

$isNew = $engine->isNew($project); // true
$isChanged = $engine->isChanged($project); // true
$diff = $engine->diff($project); // ['name' => 'Test', 'user_id' => 1]

// Flush changes initial state, object now is not new and not changed
$engine->flush($project);

$isNew = $engine->isNew($project); // false
$isChanged = $engine->isChanged($project); // false
$diff = $engine->diff($project); // []

```

## Query

### Examples:

```php
<?php

class Project extends State\Entity {
    public $id;
    public $name;
    public $user_id;
    
    public static function table() {
        return 'project';
    }
    
    public static function userId() {
        return 'user_id';
    }
}

$queryEngine = Query\Engine::mysql();

// Load project by user_id
$column = new Query\Engine\MySQL\Expression\Column(Project::userId());
$value = new Query\Engine\MySQL\Expression\Value(123);
$filter = new Query\Engine\MySQL\Expression\Equal($column, $value);
$preparedQuery = $queryEngine->buildPreparedSelectByFilter(Project::table(), $filter); // SELECT * FROM `project` WHERE `user_id` = ?;

```

## Expressions

Logical expressions (RsORM\Query\Engine\MySQL\Expression) is a part of the MySQL engine for query builder. Expressions are builded from logical operators and operands. There are 3 types of operands:

* Column
* Value
* NullValue

Operators:

* Unary operators
    * LogicalNot
* Binary operators
    * Equal, NotEqual
    * Lt, Lte, Gt, Gte
    * Is, IsNot, IsNull, IsNotNull
    * Like
* Multiple operators
    * LogicalAnd
    * LogicalOr
* Custom operators
    * Between
    * In

### Operand examples

```php
// Column
$col = new Expression\Column("id");
$col->prepare(); // `id`
$col->value(); // null

// Value
$val = new Expression\Value(123);
$val->prepare(); // ?
$val->value(); // 123

// Boolean value
$val = new Expression\Value(true);
$val->prepare(); // ?
$val->value(); // 1

// NullValue
$null = new Expression\NullValue();
$null->prepare(); // NULL
$null->value(); // null
```

### Operator examples

```php
// Binary operator
$expr = new Expression\Equal(new Expression\Column("id"), new Expression\Value(123));
$expr->prepare(); // `id` = ?
$expr->values(); // [123]

// Unary operator
$expr = new Expression\Equal(new Expression\Column("id"), new Expression\Value(123));
$expr2 = new Expression\Not($expr);
$expr2->prepare(); // NOT (`id` = ?)
$expr2->values(); // [123]

// Multiple operator
$expr = new Expression\LogicalAnd([new Expression\Value(1), new Expression\Value(2), new Expression\Value(3)]);
$expr->prepare(); // ? AND ? AND ?
$expr->values(); // [1, 2, 3]

// Between operator
$expr = new Expression\Between(new Expression\Column("id"), new Expression\Value(10), new Expression\Value(20));
$expr->prepare(); // `id` BETWEEN ? AND ?
$expr->values(); // [10, 20]

// In operator
$expr = new Expression\In(new Expression\Column("id"), [new Expression\Value(1), new Expression\Value(10), new Expression\Value(100)]);
$expr->prepare(); // `id` IN (?, ?, ?)
$expr->values(); // [1, 10, 100]
```