# Flag

Namespace: `RsORM\Query\Engine\MySQL\Flag`

Flag is a part of clause Flags, which is part of different SQL-statements. All flags implement basic `ObjectInterface` and have only one public method `prepare`. Constructor has no parameters. Here is all available flags:

 - All
 - Delayed
 - Distinct
 - DistinctRow
 - HighPriority
 - Ignore
 - LowPriority
 - Quick
 - SQLBigResult
 - SQLBufferResult
 - SQLCache
 - SQLCalcFoundRows
 - SQLNoCache
 - SQLSmallResult
 - StraightJoin

## Example

```php
$flag = new Flag\SQLSmallResult();
$flag->prepare(); // SQL_SMALL_RESULT
```
