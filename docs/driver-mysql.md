# Driver\MySQL

## Methods

 - [*__construct*](#construct)
 - [*setCharset*](#setcharset)
 - [*setOptions*](#setoptions)

### __construct

Create MySQL driver.

```php
__construct(string $host = null, int $port = null, string $user = null, string $pass = null, string $dbname = null);
```

#### Parameters

 - `$host` - host name or IP address, optional, default: 127.0.0.1.
 - `$port` - port number, optional, default: 3306.
 - `$user` - DB connection username, optional, default: root.
 - `$pass` - DB connection password, optional, default: empty string.
 - `$dbname` - DB name, optional, no default value, connection will be initialized without DB.

#### Return value

Returns Driver\MySQL object.

#### Examples

##### Example 1

```php
$driver = new Driver\MySQL();
```

##### Example 2

```php
$driver = new Driver\MySQL("anyhost.com", 1234, "user", "password", "maindb");
```

### setCharset

```php
setCharset(string $charset)
```

Set character set for current DB connection.

#### Parameters

 - *charset* - name of character set, it`s set with special constants.

#### Example

```php
$driver = new Driver\MySQL();
$driver->setCharset(Driver\MySQL\UTF8);
```

### setOptions

```php
setOptions(array $options)
```

Set PDO options for current DB connection

#### Parameters

 - *options* - array of PDO options.

#### Exmaple

```php
$driver = new Driver\MySQL();
$driver->setOptions([
	\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
]);
```
