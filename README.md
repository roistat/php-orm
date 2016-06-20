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
$fields = new Clause\Fields([
	new Argument\Field(new Argument\Column(Project::userId())),
	new Argument\Field(new Argument\Column(Project::name()))
]);
$table = new Clause\From(new Argument\Table("project"));
$filter = new Clause\Filter(new Condition\Equal(new Argument\Column(Project::userId()), new Argument\Value(123)));
$preparedQuery = $queryEngine->select($fields, $table, $filter);
$preparedQuery->prepare(); // SELECT `user_id`, `name` FROM `project` WHERE `user_id` = ?;
$preparedQuery->values(); [123]

```

## Query\Engine

Engine builds SQL statements by using MySQL class.

**Initialize engine object**

```php
$engine = new Query\Engine();
```

## Engine\MySQL

MySQL driver builds valid MySQL statements.

```php
$fields = new Clause\Fields([
	new Argument\Field(new Argument\Column("id")),
	new Argument\Field(new Argument\Column("name")),
	new Argument\Field(new Argument\Column("password")),
]);
$table = new Clause\From(new Argument\Table("users"));
$filter = new Clause\Filter(new Condition\Equal(
	new Argument\Column("deleted"),
	new Argument\Value(0)
));
$stmt = $engine->mysql()->select($fields, $table, $filter);
$stmt->prepare(); // SELECT `id`, `name`, `password` FROM `table` WHERE `deleted` = ?
$stmt->values(); // [0]
```

## MySQL\Statement

 - Select
	 - Fields
	 - From
	 - Filter
	 - Group
	 - Having
	 - Order
	 - Limit
 - Insert
 - Update
 - Delete

## MySQL\Argument

Argument is a basic entity of MySQL statement. There are several types of them:

- *Value* build value object in SQL-statement, as ?placeholder
- *NullValue* build NULL object in SQL-statement
- *Table* build object of table
- *Column* build object of column
- *Alias* build object of alias for table or column objects
- *Field* is a complex object, build field object from column and alias (the last parameter is optional)
- *Asc* is a complex object, build argument for sorting object
- *Desc* is a complex object, build argument for sorting object

### Examples

```php
// Value
$arg = new Argument\Value(123);
$arg->prepare(); // ?
$arg->value(); // 123

// NullValue
$arg = new Argument\NullValue();
$arg->prepare(); // NULL

// Column
$arg = new Argument\Column("id");
$arg->prepare(); // `id`

// Table and alias are same

// Asc and Desc
$arg = new Argument\Asc(new Argument\Column("id"));
$arg->prepare(); // `id` ASC
$arg = new Argument\Desc(new Argument\Column("id"));
$arg->prepare(); // `id` DESC

// Field
$arg = new Argument\Field(
	new Argument\Column("pass"),
	new Argument\Alias("password") // optional
);
$arg->prepare(); // `pass` AS `password`
```

## MySQL\Condition

Logical expressions (RsORM\Query\Engine\MySQL\Condition) is a part of the MySQL engine for query builder. Conditions are builded from logical operators and arguments.

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

### Operator examples

```php
// Binary operator
$expr = new Condition\Equal(new Argument\Column("id"), new Argument\Value(123));
$expr->prepare(); // `id` = ?
$expr->values(); // [123]

// Unary operator
$expr = new Condition\Equal(new Argument\Column("id"), new Argument\Value(123));
$expr2 = new Condition\Not($expr);
$expr2->prepare(); // NOT (`id` = ?)
$expr2->values(); // [123]

// Multiple operator
$expr = new Condition\LogicalAnd([new Argument\Value(1), new Argument\Value(2), new Argument\Value(3)]);
$expr->prepare(); // ? AND ? AND ?
$expr->values(); // [1, 2, 3]

// Between operator
$expr = new Condition\Between(new Argument\Column("id"), new Argument\Value(10), new Argument\Value(20));
$expr->prepare(); // `id` BETWEEN ? AND ?
$expr->values(); // [10, 20]

// In operator
$expr = new Condition\In(new Argument\Column("id"), [new Argument\Value(1), new Argument\Value(10), new Argument\Value(100)]);
$expr->prepare(); // `id` IN (?, ?, ?)
$expr->values(); // [1, 10, 100]
```