# Query\Engine

Query\Engine is abstract layer for preparing SQL queries. Namespace: `RsORM\Query`.

[**Query\Engine\MySQL**](query-engine-mysql.md) - MySQL query engine.  

## Static methods

[*mysql*](#mysql) - get MySQL engine instance.

### mysql

Get MySQL engine instance.

```php
Query\Engine\MySQL mysql()
```

#### Return values

Returns instance of `Query\Engine\MySQL`.

#### Example

```php
$mysql = Query\Engine::mysql();
```
