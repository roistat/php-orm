# RsORM

[![Build Status](https://travis-ci.org/roistat/php-orm.svg?branch=master)](https://travis-ci.org/roistat/php-orm)

# RsORM

## Overview

It is simple ORM library for PHP. This library is compatible with PHP 5.4 and higher. There are no magic methods. All code is type-hinted. It could be used in high load projects even with partitioning and sharding. There are 3 basic parts (packages). You could combine them or use some of them separately.

 - [State package](state.md) — responsible for object state management. Prepares data for usage in DB queries.
 - [Query package](query.md) — query builder. It could use data from State package or any other sources.
 - [Driver package](driver-mysql.md) — sends queries to database and parses results.

## Quick Start

Typically you can combine these 3 packages or use them alone. And at first you should define class of entity you work with. This class structure convenient to build accordingly with DB table structure.

```php
class Account extends State\Entity {
	public $id;
	public $email;
	public $password;
}
```

Then you can build MySQL query. For example, select statement.

```php
$statement = Query\Engine\MySQL\Builder::select()
	->table("accounts")
    ->build();
```

And then you can execute this statement and get result (array of defined class objects).

```php
$mysql = new Driver\MySQL();
$accounts = $mysql->fetchAllClass($statement, "Account");
/*
$accounts - array of Account objects, like this:
[
	{id: 1, email: "qwe@qwe.qwe", password: "123456"},
	{id: 2, email: "asd@asd.asd", password: "654321"},
	...
]
*/
```

It is simple example of usage RsORM. More detailed information you can find in the relevant sections.

## License

Released under the MIT License.