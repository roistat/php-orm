# Query package

Query package is situated in the `Query\Engine\MySQL` namespace. It contains classes with basic `ObjectInterface`, which has one method: `prepare` with no parameters. This method forms valid MySQL statement with `?` placeholders. `SingleValueInterface` and `MultiValueInterface` extend `ObjectInterface`. First of them has method `value` with no parameters, second - `values` with no parameters too. These methods return single value or array of values in right order, which was used in formed MySQL statement (or part of it). All classes (except `Builder` and `Builder\*`) in `Query\Engine\MySQL` namespace extend last two interfaces.

## Query package structure

All namespaces of query package are listed here. They contain classes, each of them is interpretation of any MySQL argument, operator, function, flag, clause or statement. Builder class combines all of them. With help of this class you can build the most frequently used MySQL statements. For nontrivial cases you can use combinations of other classes.

 - [Builder](query-builder.md)
 - [Argument](query-argument.md)
 - [Operator](query-operator.md)
 - [Condition](query-condition.md)
 - [Flag](query-flag.md)
 - [Func](query-func.md)
 - [Clause](query-clause.md)
 - [Statement](query-statement.md)
