<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Condition;

use RsORM\Query\Engine\MySQL\Condition;
use RsORM\Query\Engine\MySQL\Argument;
use RsORMTest;

class ExpressionTest extends RsORMTest\Base {
    
    public function testEqual() {
        $expr = new Condition\Equal(new Argument\Column("id"), new Argument\Value(123));
        $this->assertSame("`id` = ?", $expr->prepare());
        $this->assertSame([123], $expr->values());
    }
    
    public function testNotEqual() {
        $expr = new Condition\NotEqual(new Argument\Column("id"), new Argument\Value(123));
        $this->assertSame("`id` != ?", $expr->prepare());
        $this->assertSame([123], $expr->values());
    }
    
    public function testGt() {
        $expr = new Condition\Gt(new Argument\Column("id"), new Argument\Value(10));
        $this->assertSame("`id` > ?", $expr->prepare());
        $this->assertSame([10], $expr->values());
    }
    
    public function testGte() {
        $expr = new Condition\Gte(new Argument\Column("id"), new Argument\Value(10));
        $this->assertSame("`id` >= ?", $expr->prepare());
        $this->assertSame([10], $expr->values());
    }
    
    public function testLt() {
        $expr = new Condition\Lt(new Argument\Column("id"), new Argument\Value(10));
        $this->assertSame("`id` < ?", $expr->prepare());
        $this->assertSame([10], $expr->values());
    }
    
    public function testLte() {
        $expr = new Condition\Lte(new Argument\Column("id"), new Argument\Value(10));
        $this->assertSame("`id` <= ?", $expr->prepare());
        $this->assertSame([10], $expr->values());
    }
    
    public function testLike() {
        $expr = new Condition\Like(new Argument\Column("name2"), new Argument\Value("%van%"));
        $this->assertSame("`name2` LIKE ?", $expr->prepare());
        $this->assertSame(["%van%"], $expr->values());
    }
    
    public function testIs() {
        $expr = new Condition\Is(new Argument\Column("id"), new Argument\NullValue());
        $this->assertSame("`id` IS NULL", $expr->prepare());
        $this->assertSame([], $expr->values());
    }
    
    public function testIsNot() {
        $expr = new Condition\IsNot(new Argument\Column("id"), new Argument\NullValue());
        $this->assertSame("`id` IS NOT NULL", $expr->prepare());
        $this->assertSame([], $expr->values());
    }
    
    public function testIsNull() {
        $expr = new Condition\IsNull(new Argument\Column("id"));
        $this->assertSame("`id` IS NULL", $expr->prepare());
        $this->assertSame([], $expr->values());
    }
    
    public function testIsNotNull() {
        $expr = new Condition\IsNotNull(new Argument\Column("id"));
        $this->assertSame("`id` IS NOT NULL", $expr->prepare());
        $this->assertSame([], $expr->values());
    }
    
    public function testBetween() {
        $expr = new Condition\Between(new Argument\Column("id"), new Argument\Value(10), new Argument\Value(20));
        $this->assertSame("`id` BETWEEN ? AND ?", $expr->prepare());
        $this->assertSame([10, 20], $expr->values());
    }
    
    public function testIn() {
        $expr = new Condition\In(new Argument\Column("id"), [new Argument\Value(1), new Argument\Value(10), new Argument\Value(100)]);
        $this->assertSame("`id` IN (?, ?, ?)", $expr->prepare());
        $this->assertSame([1, 10, 100], $expr->values());
    }
    
    public function testLogicalNotValues() {
        $expr = new Condition\LogicalNot(new Argument\Value(false));
        $this->assertSame("NOT ?", $expr->prepare());
        $this->assertSame([0], $expr->values());
    }
    
    public function testLogicalNotColumn() {
        $expr = new Condition\LogicalNot(new Argument\Column("alive"));
        $this->assertSame("NOT `alive`", $expr->prepare());
        $this->assertSame([], $expr->values());
    }
    
    public function testLogicalNotExpression() {
        $expr0 = new Condition\Equal(new Argument\Column("alive"), new Argument\Value(1));
        $expr = new Condition\LogicalNot($expr0);
        $this->assertSame("NOT (`alive` = ?)", $expr->prepare());
        $this->assertSame([1], $expr->values());
    }
    
    public function testLogicalOrValues() {
        $expr = new Condition\LogicalOr([new Argument\Value(1), new Argument\Value(2), new Argument\Value(3)]);
        $this->assertSame("? OR ? OR ?", $expr->prepare());
        $this->assertSame([1, 2, 3], $expr->values());
    }
    
    public function testLogicalOrColumns() {
        $expr = new Condition\LogicalOr([new Argument\Column("flag1"), new Argument\Column("flag2"), new Argument\Column("flag3")]);
        $this->assertSame("`flag1` OR `flag2` OR `flag3`", $expr->prepare());
        $this->assertSame([], $expr->values());
    }
    
    public function testLogicalOrExpressions() {
        $expr1 = new Condition\Like(new Argument\Column("name"), new Argument\Value("%van%"));
        $expr2 = new Condition\Equal(new Argument\Column("alive"), new Argument\Value(1));
        $expr = new Condition\LogicalOr([$expr2, $expr1]);
        $this->assertSame("(`alive` = ?) OR (`name` LIKE ?)", $expr->prepare());
        $this->assertSame([1, "%van%"], $expr->values());
    }
    
    public function testLogicalAndValues() {
        $expr = new Condition\LogicalAnd([new Argument\Value(1), new Argument\Value(2), new Argument\Value(3)]);
        $this->assertSame("? AND ? AND ?", $expr->prepare());
        $this->assertSame([1, 2, 3], $expr->values());
    }
    
    public function testLogicalAndColumns() {
        $expr = new Condition\LogicalAnd([new Argument\Column("flag1"), new Argument\Column("flag2"), new Argument\Column("flag3")]);
        $this->assertSame("`flag1` AND `flag2` AND `flag3`", $expr->prepare());
        $this->assertSame([], $expr->values());
    }
    
    public function testLogicalAndExpressions() {
        $expr1 = new Condition\Like(new Argument\Column("name"), new Argument\Value("%van%"));
        $expr2 = new Condition\Equal(new Argument\Column("alive"), new Argument\Value(1));
        $expr = new Condition\LogicalAnd([$expr2, $expr1]);
        $this->assertSame("(`alive` = ?) AND (`name` LIKE ?)", $expr->prepare());
        $this->assertSame([1, "%van%"], $expr->values());
    }
    
}
