# Operator

Namespace: `RsORM\Query\Engine\MySQL\Operator`

Now it is realized only one MySQL operator - assign operator. `Assign` class is instance of `MultiValueInterface`, has two methods: `prepare` and `values`, has two input parameters, each of them should be instance of `ObjectInterface`, it's no other restrictions. This class is similar to `Condition\Equal`, but it is used in different cases.

## Example

```php
$assign = new Operator\Assign(
	new Argument\Column("id"),
	new Argument\Value(123)
);
$assign->prepare(); // `id` = ?
$assign->values(); // [123]
```
