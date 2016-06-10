<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDBTest\Query\Engine\MySQL\Expression;

use RSDB\Query\Engine\MySQL\Expression;
use RSDBTest;

class ExpressionTest extends RSDBTest\Base {
    
    public function testColumn() {
        $col = new Expression\Column("id");
        $this->assertSame("`id`", $col->prepare());
        $this->assertSame(null, $col->value());
    }
    
    public function testValueInt() {
        $val = new Expression\Value(123);
        $this->assertSame("?", $val->prepare());
        $this->assertSame(123, $val->value());
    }
    
    public function testValueFloat() {
        $val = new Expression\Value(3.14);
        $this->assertSame("?", $val->prepare());
        $this->assertSame(3.14, $val->value());
    }
    
    public function testValueString() {
        $val = new Expression\Value("qwe");
        $this->assertSame("?", $val->prepare());
        $this->assertSame("qwe", $val->value());
    }
    
    public function testValueBool() {
        $val = new Expression\Value(true);
        $this->assertSame("?", $val->prepare());
        $this->assertSame(1, $val->value());
        $val = new Expression\Value(false);
        $this->assertSame("?", $val->prepare());
        $this->assertSame(0, $val->value());
    }
    
    public function testNullValue() {
        $null = new Expression\NullValue();
        $this->assertSame("NULL", $null->prepare());
        $this->assertSame(null, $null->value());
    }
    
    public function testEqual() {
        $expr = new Expression\Equal(new Expression\Column("id"), new Expression\Value(123));
        $this->assertSame("`id` = ?", $expr->prepare());
        $this->assertSame([123], $expr->values());
    }
    
    public function testNotEqual() {
        $expr = new Expression\NotEqual(new Expression\Column("id"), new Expression\Value(123));
        $this->assertSame("`id` != ?", $expr->prepare());
        $this->assertSame([123], $expr->values());
    }
    
    public function testGt() {
        $expr = new Expression\Gt(new Expression\Column("id"), new Expression\Value(10));
        $this->assertSame("`id` > ?", $expr->prepare());
        $this->assertSame([10], $expr->values());
    }
    
    public function testGte() {
        $expr = new Expression\Gte(new Expression\Column("id"), new Expression\Value(10));
        $this->assertSame("`id` >= ?", $expr->prepare());
        $this->assertSame([10], $expr->values());
    }
    
    public function testLt() {
        $expr = new Expression\Lt(new Expression\Column("id"), new Expression\Value(10));
        $this->assertSame("`id` < ?", $expr->prepare());
        $this->assertSame([10], $expr->values());
    }
    
    public function testLte() {
        $expr = new Expression\Lte(new Expression\Column("id"), new Expression\Value(10));
        $this->assertSame("`id` <= ?", $expr->prepare());
        $this->assertSame([10], $expr->values());
    }
    
    public function testLike() {
        $expr = new Expression\Like(new Expression\Column("name2"), new Expression\Value("%van%"));
        $this->assertSame("`name2` LIKE ?", $expr->prepare());
        $this->assertSame(["%van%"], $expr->values());
    }
    
    public function testIs() {
        $expr = new Expression\Is(new Expression\Column("id"), new Expression\NullValue());
        $this->assertSame("`id` IS NULL", $expr->prepare());
        $this->assertSame([], $expr->values());
    }
    
    public function testIsNot() {
        $expr = new Expression\IsNot(new Expression\Column("id"), new Expression\NullValue());
        $this->assertSame("`id` IS NOT NULL", $expr->prepare());
        $this->assertSame([], $expr->values());
    }
    
    public function testIsNull() {
        $expr = new Expression\IsNull(new Expression\Column("id"));
        $this->assertSame("`id` IS NULL", $expr->prepare());
        $this->assertSame([], $expr->values());
    }
    
    public function testIsNotNull() {
        $expr = new Expression\IsNotNull(new Expression\Column("id"));
        $this->assertSame("`id` IS NOT NULL", $expr->prepare());
        $this->assertSame([], $expr->values());
    }
    
//    public function testBetween() {
//        $expr = new Expression\Between(new Expression\Column("id"), new Expression\Value(10), new Expression\Value(20));
//        $this->assertSame("`id` BETWEEN ? AND ?", $expr->prepare());
//        $this->assertSame([10, 20], $expr->values());
//    }
//    
//    public function testIn() {
//        $expr = new Expression\In(new Expression\Column("id"), [new Expression\Value(1), new Expression\Value(10), new Expression\Value(100)]);
//        $this->assertSame("`id` IN (?, ?, ?)", $expr->prepare());
//        $this->assertSame([1, 10, 100], $expr->values());
//    }
    
    public function testLogicalNotValues() {
        $expr = new Expression\LogicalNot(new Expression\Value(false));
        $this->assertSame("NOT ?", $expr->prepare());
        $this->assertSame([0], $expr->values());
    }
    
    public function testLogicalNotColumn() {
        $expr = new Expression\LogicalNot(new Expression\Column("alive"));
        $this->assertSame("NOT `alive`", $expr->prepare());
        $this->assertSame([], $expr->values());
    }
    
    public function testLogicalNotExpression() {
        $expr0 = new Expression\Equal(new Expression\Column("alive"), new Expression\Value(1));
        $expr = new Expression\LogicalNot($expr0);
        $this->assertSame("NOT (`alive` = ?)", $expr->prepare());
        $this->assertSame([1], $expr->values());
    }
    
    public function testLogicalOrValues() {
        $expr = new Expression\LogicalOr([new Expression\Value(1), new Expression\Value(2), new Expression\Value(3)]);
        $this->assertSame("? OR ? OR ?", $expr->prepare());
        $this->assertSame([1, 2, 3], $expr->values());
    }
    
    public function testLogicalOrColumns() {
        $expr = new Expression\LogicalOr([new Expression\Column("flag1"), new Expression\Column("flag2"), new Expression\Column("flag3")]);
        $this->assertSame("`flag1` OR `flag2` OR `flag3`", $expr->prepare());
        $this->assertSame([], $expr->values());
    }
    
    public function testLogicalOrExpressions() {
        $expr1 = new Expression\Like(new Expression\Column("name"), new Expression\Value("%van%"));
        $expr2 = new Expression\Equal(new Expression\Column("alive"), new Expression\Value(1));
        $expr = new Expression\LogicalOr([$expr2, $expr1]);
        $this->assertSame("(`alive` = ?) OR (`name` LIKE ?)", $expr->prepare());
        $this->assertSame([1, "%van%"], $expr->values());
    }
    
    public function testLogicalAndValues() {
        $expr = new Expression\LogicalAnd([new Expression\Value(1), new Expression\Value(2), new Expression\Value(3)]);
        $this->assertSame("? AND ? AND ?", $expr->prepare());
        $this->assertSame([1, 2, 3], $expr->values());
    }
    
    public function testLogicalAndColumns() {
        $expr = new Expression\LogicalAnd([new Expression\Column("flag1"), new Expression\Column("flag2"), new Expression\Column("flag3")]);
        $this->assertSame("`flag1` AND `flag2` AND `flag3`", $expr->prepare());
        $this->assertSame([], $expr->values());
    }
    
    public function testLogicalAndExpressions() {
        $expr1 = new Expression\Like(new Expression\Column("name"), new Expression\Value("%van%"));
        $expr2 = new Expression\Equal(new Expression\Column("alive"), new Expression\Value(1));
        $expr = new Expression\LogicalAnd([$expr2, $expr1]);
        $this->assertSame("(`alive` = ?) AND (`name` LIKE ?)", $expr->prepare());
        $this->assertSame([1, "%van%"], $expr->values());
    }
    
}
