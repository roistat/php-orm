# Condition

Namespace: `RsORM\Query\Engine\MySQL\Condition`

All classes in this namespace corresponds MySQL logical operators and expressions. All this classes are instances of abstract classes, which are listed bellow:

 - AbstractOperator - instance of `AbstractExpression` and `MultiValueInterface`.
	 - AbstractCustomOperator
	 - AbstractSimpleOperator - all simple operators has common rules of preparing.
		 - AbstractUnaryOperator - has one input parameter.
		 - AbstractBinaryOperator - has two input parameters.
		 - AbstractMultipleOperator - has one or more input parameters (variable number).

All input parameters are instance of `ObjectInterface`.

 - [Unary operators](#unary-operators)
 - [Binary operators](#binary-operators)
 - [Multiple operators](#multiple-operators)
 - [Custom operators](#custom-operators)

## Unary operators

In this section only one class (instance of `Operator\AbstractUnaryOperator`) - `LogicalNot`.

### Example

```php
$expr = new Condition\Equal(
	new Argument\Column("id"),
	new Argument\Value(123)
);
$expr2 = new Condition\LogicalNot($expr);
$expr2->prepare(); // NOT (`id` = ?)
$expr2->values(); // [123]
```

## Binary operators

All classes in this section are instance of `Operator\AbstractBinaryOperator`.

 - Equal
 - NotEqual
 - Lt
 - Lte
 - Gt
 - Gte
 - Is
 - IsNot
 - IsNull
 - IsNotNull
 - Like

### Example

```php
$expr = new Condition\Equal(
	new Argument\Column("id"),
	new Argument\Value(123)
);
$expr->prepare(); // `id` = ?
$expr->values(); // [123]
```

## Multiple operators

All classes in this section are instance of `Operator\AbstractMultipleOperator`

 - LogicalAnd
 - LogicalOr

### Example

```php
$eq1 = new Condition\Equal(
	new Argument\Column("id"),
	new Argument\Value(1)
);
$eq2 = new Condition\Equal(
	new Argument\Column("id"),
	new Argument\Value(2)
);
$eq3 = new Condition\Equal(
	new Argument\Column("id"),
	new Argument\Value(3)
);
$expr = new Condition\LogicalOr([$eq1, $eq2, $eq3]);
$expr->prepare(); // (`id` = ?) OR (`id` = ?) OR (`id` = ?)
$expr->values(); // [1, 2, 3]
```

## Custom operators

All classes in this section are instance of `Operator\AbstractCustomOperator` and have different structure of input parameters and construction logic.

 - Between
 - In

### Example 1 Between

```php
$expr = new Condition\Between(
	new Argument\Column("id"),
	new Argument\Value(10),
	new Argument\Value(20)
);
$expr->prepare(); // `id` BETWEEN ? AND ?
$expr->values(); // [10, 20]
```

### Example 2 In

```php
$expr = new Condition\In(
	new Argument\Column("id"),
	[
		new Argument\Value(1),
		new Argument\Value(10),
		new Argument\Value(100)
	]
);
$expr->prepare(); // `id` IN (?, ?, ?)
$expr->values(); // [1, 10, 100]
```