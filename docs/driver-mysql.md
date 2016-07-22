# Driver\MySQL

PDO abstract layer. Connection is initialized by first prepare / execute.

## Methods

 - [*__construct*](#__construct) - create Driver\MySQL object.
 - [*setCharset*](#setcharset) - set character set.
 - [*setOptions*](#setoptions) - set valid PDO options.
 - [*fetchAssoc*](#fetchassoc) - prepare, execute SQL-statement and return row from executed query as associated array.
 - [*fetchAllAssoc*](#fetchallassoc) - prepare, execute SQL-statement and return all rows from executed query as associated array.
 - [*fetchClass*](#fetchclass) - prepare, execute SQL-statement and return row from executed query as object of defined class.
 - [*fetchAllClass*](#fetchallclass) - prepare, execute SQL-statement and return all rows from executed query as array of objects of defined class.
 - [*query*](#query) - prepare and execute generated SQL-statement.
 - [*queryCustom*](#querycustom) - prepare and execute custom SQL-statement (string).
 - [*getLastInsertId*](#getlastinsertid) - get last insert ID.

### __construct

Create MySQL driver.

```php
__construct(string $host = null, int $port = null,
	string $user = null, string $pass = null,
	string $dbname = null)
```

#### Parameters

 - *host* - host name or IP address, optional, default: 127.0.0.1.
 - *port* - port number, optional, default: 3306.
 - *user* - DB connection username, optional, default: root.
 - *pass* - DB connection password, optional, default: empty string.
 - *dbname* - DB name, optional, no default value, connection will be initialized without DB.

#### Examples

##### Example 1 No input parameters

```php
$driver = new Driver\MySQL();
```

##### Example 2 All input parameters

```php
$driver = new Driver\MySQL("anyhost.com", 1234, "user", "password", "maindb");
```

### setCharset

Set character set for current DB connection.

```php
setCharset(string $charset)
```

#### Parameters

 - *charset* - name of character set, charset are specified by constants.

#### Example

```php
$driver = new Driver\MySQL();
$driver->setCharset(Driver\MySQL\UTF8);
```

### setOptions

Set valid PDO options for current DB connection.

```php
setOptions(array $options)
```

#### Parameters

 - *options* - array of PDO options.

#### Example

```php
$driver = new Driver\MySQL();
$driver->setOptions([
	\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
]);
```

### fetchAssoc

Prepare, execute SQL-statement and return row from executed query as associated array.

```php
array fetchAssoc(Statement\AbstractStatement $statement)
```

#### Parameters

 - *statement* - generated SQL-statement, `AbstractStatement` object.

#### Example

```php
$driver = new Driver\MySQL();
$query = Query\Engine\MySQL\Builder::select()
	->from("users");
$statement = $query->build();
$driver->fetchAssoc($statement); // it returns anything like this: ["id" => 1, "name" => "Mike"]
```

### fetchAllAssoc

Prepare, execute SQL-statement and return all rows from executed query as associated array.

```php
array fetchAllAssoc(Statement\AbstractStatement $statement)
```

#### Parameters

 - *statement* - generated SQL-statement, `AbstractStatement` object.

#### Example

```php
$driver = new Driver\MySQL();
$query = Query\Engine\MySQL\Builder::select()
	->from("users");
$statement = $query->build();
$driver->fetchAllAssoc($statement); // it returns anything like this: [["id" => 1, "name" => "Mike"], ["id" => 2, "name" => "Ivan"]]
```

### fetchClass

Prepare, execute SQL-statement and return row from executed query as object of defined class.

```php
State\Entity fetchClass(Statement\AbstractStatement $statement, string $class)
```

#### Parameters

 - *statement* - generated SQL-statement, `AbstractStatement` object.
 - *class* - class name.

#### Example

```php
$driver = new Driver\MySQL();
class User extends State\Entity {
	public $id;
	public $name;
}
$query = Query\Engine\MySQL\Builder::select()
	->from("users");
$statement = $query->build();
$driver->fetchClass($statement, "User");
// {id: 1, name: Mike}
```

### fetchAllClass

Prepare, execute SQL-statement and return all rows from executed query as array of objects of defined class.

```php
State\Entity[] fetchAllClass(Statement\AbstractStatement $statement, string $class)
```

#### Parameters

 - *statement* - generated SQL-statement, `AbstractStatement` object.
 - *class* - class name.

#### Example

```php
$driver = new Driver\MySQL();
class User extends State\Entity {
	public $id;
	public $name;
}
$query = Query\Engine\MySQL\Builder::select()
	->from("users");
$statement = $query->build();
$driver->fetchAllClass($statement, "User");
/*
[
	{id: 1, name: Mike},
	{id: 2, name: Ivan}
]
*/
```

### query

Prepare and execute generated SQL-statement.

```php
query(Statement\AbstractStatement $statement)
```

#### Parameters

 - *statement* - generated SQL-statement, `AbstractStatement` object.

#### Example

```php
$driver = new Driver\MySQL();
$query = Query\Engine\MySQL\Builder::update([
	"flag" => 1
])->table("users");
$statement = $query->build();
$driver->query($statement);
```

### queryCustom

Prepare and execute custom SQL-statement (string).

```php
queryCustom(string $query)
```

#### Parameters

 - *query* - SQL query (string).

#### Example

```php
$driver = new Driver\MySQL();
$driver->query("DELETE FROM `table` WHERE `id` = 1");
```

### getLastInsertId

Get last insert ID.

```php
string getLastInsertId()
```

#### Example

```php
$driver = Driver\MySQL();
$query = Query\Engine\MySQL\Builder::insert([
	"id" => 3, "name" => "Egor"
])->table("users");
$statement = $query->build();
$driver->query($statement);
$driver->getLastInsertId(); // 3
```