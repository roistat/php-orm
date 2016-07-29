# Driver\MySQL

It is PDO abstract layer. Connection is initialized by first prepare / execute. All input parameters in `Driver\MySQL` object constructor are optional:

```php
__construct(
	string $host = null, // 127.0.0.1
	int $port = null, // 3306
	string $user = null, // root
	string $pass = null, // no default password
	string $dbname = null // no default DB
)
```

Bellow you can see simple example of creating `Driver\MySQL` object.

```php
$driver = new Driver\MySQL();
```

Bellow we create object for connection with DB `main_db` on server with IP 1.2.3.4 on 1234 port with user `user` and paswword `123456`.

```php
$driver = new Driver\MySQL("1.2.3.4", 1234, "user", "123456", "main_db");
```

`Driver\MySQL` has methods:

 - [*setCharset*](#setcharset) - set character set.
 - [*setOptions*](#setoptions) - set valid PDO options.
 - [*fetchAssoc*](#fetchassoc) - prepare, execute SQL-statement and return row from executed query as associated array.
 - [*fetchAllAssoc*](#fetchallassoc) - prepare, execute SQL-statement and return all rows from executed query as associated array.
 - [*fetchClass*](#fetchclass) - prepare, execute SQL-statement and return row from executed query as object of defined class.
 - [*fetchAllClass*](#fetchallclass) - prepare, execute SQL-statement and return all rows from executed query as array of objects of defined class.
 - [*query*](#query) - prepare and execute generated SQL-statement.
 - [*queryCustom*](#querycustom) - prepare and execute custom SQL-statement (string).
 - [*getLastInsertId*](#getlastinsertid) - get last insert ID.

## setCharset

Set character set for current DB connection, charset are specified by constants of `Driver\MySQL` class (for example, `UTF8` constant).

Bellow we set utf-8 charset for already existing DB driver.

```php
$driver->setCharset(Driver\MySQL\UTF8);
```

## setOptions

Set valid PDO options (array of PDO options) for current DB connection.

For example, we can set utf-8 charset for existing DB driver by PDO options:

```php
$driver->setOptions([
	\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
]);
```

## fetchAssoc

Prepare, execute SQL-statement and return row from executed query as associated array. Has one input parameter - already generated SQL-statement (instance of `Statement\AbstractStatement`) and returns array (one row).

```php
$statement = Query\Engine\MySQL\Builder::select()
	->from("users")
	->build();
$driver->fetchAssoc($statement);
/*
it returns anything like this:
[
	"id" => 1,
	"name" => "Mike"
]
*/
```

## fetchAllAssoc

Prepare, execute SQL-statement and return all rows from executed query as associated array. Has one input parameter - already generated SQL-statement (instance of `Statement\AbstractStatement`) and returns array (all rows).

```php
$statement = Query\Engine\MySQL\Builder::select()
	->from("users")
	->build();
$driver->fetchAllAssoc($statement);
/*
it returns anything like this:
[
	[
		"id" => 1,
		"name" => "Mike"
	],
	[
		"id" => 2,
		"name" => "Ivan"
	]
]
*/
```

## fetchClass

Prepare, execute SQL-statement and return row from executed query as object of defined class.

```php
State\Entity fetchClass(Statement\AbstractStatement $statement, string $class)
```

```php
class User extends State\Entity {
	public $id;
	public $name;
}
$statement = Query\Engine\MySQL\Builder::select()
	->from("users")
	->build();
$driver->fetchClass($statement, "User");
// {id: 1, name: Mike}
```

## fetchAllClass

Prepare, execute SQL-statement and return all rows from executed query as array of objects of defined class.

```php
State\Entity[] fetchAllClass(Statement\AbstractStatement $statement, string $class)
```

```php
class User extends State\Entity {
	public $id;
	public $name;
}
$statement = Query\Engine\MySQL\Builder::select()
	->from("users")
	->build();
$driver->fetchAllClass($statement, "User");
/*
[
	{id: 1, name: Mike},
	{id: 2, name: Ivan}
]
*/
```

## query

Prepare and execute generated SQL-statement. Doesn't return any result.

```php
query(Statement\AbstractStatement $statement)
```

```php
$statement = Query\Engine\MySQL\Builder::update(["flag" => 1])
    ->table("users")
    ->build();
$driver->query($statement);
```

## queryCustom

Prepare and execute custom SQL-statement (string).

```php
queryCustom(string $query)
```

```php
$driver->query("DELETE FROM `table` WHERE `id` = 1");
```

## getLastInsertId

Get last insert ID.

```php
string getLastInsertId()
```

```php
$data = ["id" => 3, "name" => "Egor"];
$statement = Query\Engine\MySQL\Builder::insert($data)
    ->table("users")
    ->build();
$driver->query($statement);
$driver->getLastInsertId(); // 3
```