# RsORM

[![Build Status](https://travis-ci.org/roistat/orm.svg?branch=master)](https://travis-ci.org/roistat/orm)

Simple and fast DB utils with no magic methods. It could be used in high load projects even with partitioning and sharding. 

* State package — responsible for object state management. Returns the data that prepared for usage in DB queries.
* Query package — responsible for creating queries from ORM data to specified DB engine.
* Driver package — responsible for executing ORM generated queries.

[**Basic Usage**](#basic-usage)  
[**Tests**](#tests)  
[**License**](#license)  
[**Documentation**](#docs)

# Basic usage

It is the simple example of usage ORM, which includes initialization of MySQL driver and state engine, declaration of state entity class and procedures of creating, selecting and deleting objects.

```php
// Initialize MySQL driver and State engine
$driver = new Driver\MySQL();
$state = State\Engine::getInstance();
$query = Query\Engine::mysql();

// Declare class for Client entity
class Client extends State\Entity {
	public $id;
	public $name;
	public $age;
	public static function table() {
		return "user";
	}
	public static function id() {
		return "id";
	}
	public static function name() {
		return "name";
	}
	public static function age() {
		return "age";
	}
}

// Now we can create new client
$client = new Client();
$client->name = "Mike";
$client->age = 30;

// Prepare INSERT statement
$table = new Clause\Into(
	new Argument\Table(Client::table())
);
$diff = $state->diff($client);
// ["name" => "Mike", "age" => 30]
$vals = array_values($diff);
$values = new Clause\Values([
	new Argument\Value($vals[0]),
	new Argument\Value($vals[1]),
]);
$keys = array_keys($diff);
$fields = new Clause\Fields([
	new Argument\Field(new Argument\Column($keys[0])),
	new Argument\Field(new Argument\Column($keys[1])),
]);
$statement = $query->insert($table, $values, $fields);

// Save client into database table
$driver->query($statement);
$state->flush($client);

// Prepare select statement
$fields = new Clause\Fields([
	new Argument\Field(new Argument\Column(Client::name())),
	new Argument\Field(new Argument\Column(Client::age())),
]);
$from = new Clause\From(
	new Argument\Table(Client::table())
);
$filter = new Clause\Filter(
	new Condition\Equal(
		new Argument\Column(Client::id()),
		new Argument\Value(123)
	)
);
$statement = $query->select($fields, $from, $filter);

// Get client with id = 123
$client = $driver->fetchClass($statement, "Client");

// Prepare DELETE statement
$table = new Clause\From(
	new Argument\Table(Client::table())
);
$filter = new Clause\Filter(
	new Condition\Equal(
		new Argument\Column(Client::id()),
		new Argument\Value($client->id)
	)
);
$statement = $query->delete($table, $filter);

// Remove current client from DB
$driver->execute($statement);
```

# Tests

All tests are located in directory `tests/` in source directory. They have identical namespace structure with main namespace `RsORMTest`.

To run the tests:

```
cd tests/
phpunit
```

or

```
phpunit --configuration tests/phpunit.xml
```

# License

license text

# Documentation

[**State\Engine**](#stateengine)  
[**State\Entity**](#stateentity)  
[**Driver\MySQL**](#drivermysql)  
[**Engine\MySQL**](#enginemysql)  
[**MySQL\Argument**](#mysqlargument)  
[**MySQL\Operator**](#mysqloperator)  
[**MySQL\Condition**](#mysqlcondition)  
[**MySQL\Clause**](#mysqlclause)  
[**MySQL\Statement**](#mysqlstatement)

## State\Engine

`RsORM\State\Engine`

All entities should be extended from ```RsORM\State\Entity``` which encapsulates object state data and get/set methods. All actions are going in ```RsORM\State\Engine```.
Engine has several methods: ```isNew```, ```isChanged```, ```diff```. Diff method returns array of changed fields with values.

### Examples:

```php
class Project extends State\Entity {
    public $id;
    public $name;
    public $user_id;
}
$engine = State\Engine::getInstance();

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

## State\Entity

`RsORM\State\Entity`

### Examples:

```php
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

## Driver\MySQL

`RsORM\Driver\MySQL`

PDO abstract layer. Connection is initialized by first prepare / execute.

 - ```__construct(string $host, int $port, string $user, string $pass, string $dbname)``` All parameters are optional.
 - ```setCharset(string $charset)``` Charset are specified by constants. For example, ```Driver\MySQL::UTF8```
 - ```setOptions(array $options)``` Set valid PDO options.
 - ```fetchAssoc(Statement\AbstractStatement $statement)``` Prepare, execute SQL-statement and return associated array (row).
 - ```fetchAllAssoc(Statement\AbstractStatement $statement)``` Prepare, execute SQL-statement and return associated array (rows).
 - ```fetchClass(Statement\AbstractStatement $statement, string $class)``` Prepare, execute SQL-statement and return object of specified class.
 - ```fetchAllClass(Statement\AbstractStatement $statement, string $class)``` Prepare, execute SQL-statement and return specified class object array.
 - ```query(Statement\AbstractStatement $statement)``` Prepare and execute SQL-statement.
 - ```getLastInsertId()``` Return last insert ID.

### Example

```php
$dbh = new Driver\MySQL("127.0.0.1", 3306, "root", "123456", "main_db");
$dbh->setCharset(Driver\MySQL::UTF8);
$dbh->setOptions([
	\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
]);
$stmt = Query\Engine::mysql()->select(...);
$dbh->fetchAssoc($stmt); // return row
$dbh->fetchAllAssoc($stmt); // return array
$dbh->fetchClass($stmt, "User"); // return object of User class
$dbh->fetchAllClass($stmt, "User"); // return array of User objects
$stmt = Query\Engine::mysql()->insert(...);
$dbh->query($stmt); // true on success and false on failure
$dbh->getLastInsertId(); // return last insert ID
```

## Query\Engine

`RsORM\Query\Engine`

Engine builds SQL statements by using MySQL class.

## Engine\MySQL

`RsORM\Query\Engine\MySQL`

MySQL driver builds valid MySQL statements.

`Query\Engine::mysql()->select(...)`

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
$engine = Query\Engine::mysql();
$stmt = $engine->select($fields, $table, $filter);
$stmt->prepare(); // SELECT `id`, `name`, `password` FROM `table` WHERE `deleted` = ?
$stmt->values(); // [0]
```

## MySQL\Argument

`RsORM\Query\Engine\MySQL\Argument`

Argument is a basic entity of MySQL statement. There are several types of them:

- *Any* build SQL identifier for any field
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
// Any
$arg = new Argument\Any();
$arg->prepare(); // *

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

## MySQL\Operator

`RsORM\Query\Engine\MySQL\Operator`

Operator is a basic expression in SQL syntax. Operators implement ```MultiValueInterface```. There are several types of them:

- Unary operators - operators with only one operand
Syntax: ```new Operator($operand)```
- Binary operators - operators with two operands
Syntax: ```new Operator($operand1, $operand2)```
- Multiple operators - operators with one or more operands
Syntax: ```new Operator([$operand1, $operand2, ...])```
- Custom operators - operators with non-standart structure

Usually operators are the part of filter entity in SQL statements. That`s why, the most part of them are located in the ```MySQL\Condition``` namespace. Non-logic operators are located here, in ```MySQL\Operator```.

### Example

```php
// Assign
$operator = new Operator\Assign(
	new Argument\Column("id"),
	new Argument\Value(123)
);
$operator->prepare(); // `id` = ?
$operator->values(); // [123]
```

## MySQL\Condition

`RsORM\Query\Engine\MySQL\Condition`

Logical expressions consist of operators. Logical expressions are the part of the MySQL engine for query builder. Conditions are built from logical operators and arguments.

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

### Examples

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

## MySQL\Clause

`RsORM\Query\Engine\MySQL\Clause`

Clause is a part of SQL-statement. It builds from arguments, operators, conditions, SQL-expressions. All clauses implement ```MultiValueInterface```.

### Examples

```php
// Fields
$fields = new Clause\Fields([
	new Argument\Field(new Argument\Column("id")),
	new Argument\Field(new Argument\Column("name")),
]);
$fields->prepare(); // `id`, `name`
$fields->values(); // []

// InsertFields
$fields = new Clause\InsertFields([
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
```

## MySQL\Statement

`RsORM\Query\Engine\MySQL\Statement`

SQL statements implement ```MultiValueInterface``` and are built from ```MySQL\Clause``` objects.

```php
Select::__construct(
	Clause\Fields $fields,
	Clause\From $table = null,
	Clause\Filter $filter = null,
	Clause\Group $group = null,
	Clause\Having $having = null,
	Clause\Order $order = null,
	Clause\Limit $limit = null
);
```

- ```$fields``` - set of fields for Select statement, required parameter
- ```$table``` - target table, optional parameter
- ```$filter``` - condition for select statement
- ```$group``` - grouping
- ```$having``` - having condition
- ```$order``` - ordering (it can be asc or desc, asc by default)
- ```$limit``` - limiting

```php
Delete::__construct(
	Clause\From $table,
	Clause\Filter $filter = null,
	Clause\Order $order = null,
	Clause\Limit $limit = null
);
```

- ```$table``` - required parameter
- ```$filter```, ```$order```, ```$limit``` - are the same as in select statement

```php
Insert::__construct(
	Clause\Into $table,
	Clause\Values $values,
	Clause\Fields $fields = null
);
```

- ```$table``` - required parameter
- ```$values``` - required parameter, set values
- ```$fields``` - optional parameter, set of inserted fields

```php
Update::__construct(
	Clause\Target $table,
	Clause\Set $set,
	Clause\Filter $filter = null,
	Clause\Order $order = null,
	Clause\Limit $limit = null
);
```

- ```$table``` - required parameter
- ```$set``` - also required parameter, set of key-value
- ```$filter```, ```$order```, ```$limit``` - are the same as in select statement

### Examples

```php
// Select
$fields = new Clause\Fields([
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
$stmt = new Statement\Select($fields, $table, $filter, $group, $having, $order, $limit);
$stmt->prepare(); // SELECT `id`, `name` FROM `table` WHERE (`id` = ?) OR (`id` = ?) GROUP BY `id` HAVING `alive` = ? ORDER BY `id` DESC LIMIT ?, ?
$stmt->values(); // [10, 20, 1, 5, 10]

// Delete
$table = new Clause\From(new Argument\Table("table"));
$filter = new Clause\Filter(new Condition\LogicalOr([
	new Condition\Equal(new Argument\Column("id"), new Argument\Value(10)),
	new Condition\Equal(new Argument\Column("id"), new Argument\Value(20)),
]));
$order = new Clause\Order([new Argument\Desc(new Argument\Column("id"))]);
$limit = new Clause\Limit(new Argument\Value(5), new Argument\Value(10));
$stmt = new Statement\Delete($table, $filter, $order, $limit);
$stmt->prepare(); // DELETE FROM `table` WHERE (`id` = ?) OR (`id` = ?) ORDER BY `id` DESC LIMIT ?, ?
$stmt->values(); // [10, 20, 5, 10]

// Insert
$fields = new Clause\InsertFields([
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
$stmt = new Statement\Insert($table, $values, $fields);
$stmt->prepare(); // INSERT INTO `table` (`id`, `name`, `qwe`) VALUES (?, ?, NULL)
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
$stmt = new Statement\Update($table, $set, $filter, $order, $limit);
$stmt->prepare(); // "UPDATE `table` SET `id` = ?, `name` = ?, `qwerty` = NULL WHERE (`id` = ?) OR (`id` = ?) ORDER BY `id` DESC LIMIT ?, ?
$stmt->values(); // [1, "Mike", 10, 20, 5, 10]
```
