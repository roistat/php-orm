# Query\Engine\MySQL\Condition

All classes in this namespace corresponds MySQL logical operators and expressions. All this classes are instances of abstract classes, which are listed bellow:

 - AbstractOperator - instance of `AbstractExpression` and `MultiValueInterface`.
	 - AbstractCustomOperator
	 - AbstractSimpleOperator - all simple operators has common rules of preparing.
		 - AbstractUnaryOperator - has one input parameter.
		 - AbstractBinaryOperator - has two input parameters.
		 - AbstractMultipleOperator - has one or more input parameters (variable number).

All input parameters are instance of `ObjectInterface`. Bellow you can see list of all these classes:

 - Unary operators
	 - LogicalNot
 - Binary operators
	 - Equal, NotEqual
	 - Lt, Lte, Gt, Gte
	 - Is, IsNot, IsNull, IsNotNull
	 - Like
 - Multiple operators
	 - LogicalAnd
	 - LogicalOr
 - Custom operators
	 - Between
	 - In

## Examples

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
