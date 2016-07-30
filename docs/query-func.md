# Func

Namespace: `RsORM\Query\Engine\MySQL\Func`

Predefined MySQL functions are part of various MySQL statements.

Functions with optional distinct parameter:

 - Avg
 - Count
 - Sum

Functions with multiple parameters:

 - Concat

## Examples

```php
// COUNT without DISTINCT
$func = new Func\Count(new Argument\Column("id"));
$func->prepare(); // COUNT(`id`)
$func->values(); // []

// COUNT with DISTINCT
$func = new Func\Count(new Argument\Column("id"), true);
$func->prepare(); // COUNT(DISTINCT `id`)
$func->values(); // []

// CONCAT
$func = new Func\Concat([
	new Argument\Value("qwe"),
	new Argument\Column("infix"),
	new Argument\Value("rty"),
]);
$func->prepare(); // CONCAT(?, `infix`, ?)
$func->values(); // ["qwe", "rty"]

// Select with function example
$func = new Func\Concat([
	new Argument\Value("prefix"),
	new Argument\Value("postfix"),
]);
$fields = new Clause\Objects([$func]);
$stmt = Query\Engine::mysql()->select($fields);
$stmt->prepare(); // SELECT CONCAT(?, ?)
$stmt->values(); // ["prefix", "postfix"]
```
