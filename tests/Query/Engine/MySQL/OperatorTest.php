<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDBTest\Query\Engine\MySQL;

use RSDB\Query\Engine\MySQL\Operator;
use RSDB\Query\Engine\MySQL\Operand;
use RSDBTest;

class OperatorTest extends RSDBTest\Base {
    
    public function testEqual() {
        $operator = new Operator\Equal(new Operand\Value(1), new Operand\Value(2));
        $this->assertEquals("? = ?", $operator->prepare());
        $this->assertEquals([1, 2], $operator->values());
        
        $operator = new Operator\Equal(new Operand\Column("id"), new Operand\Value(3));
        $this->assertEquals("`id` = ?", $operator->prepare());
        $this->assertEquals([3], $operator->values());
        
        $operator = new Operator\Equal(new Operand\Value(2), new Operand\Column("id"));
        $this->assertEquals("? = `id`", $operator->prepare());
        $this->assertEquals([2], $operator->values());
        
        $operator = new Operator\Equal(new Operand\Column("parent_id"), new Operand\Column("id"));
        $this->assertEquals("`parent_id` = `id`", $operator->prepare());
        $this->assertEquals([], $operator->values());
    }
    
    public function testNotEqual() {
        $operator = new Operator\NotEqual(new Operand\Value(1), new Operand\Value(2));
        $this->assertEquals("? <> ?", $operator->prepare());
        $this->assertEquals([1, 2], $operator->values());
        
        $operator = new Operator\NotEqual(new Operand\Column("id"), new Operand\Value(3));
        $this->assertEquals("`id` <> ?", $operator->prepare());
        $this->assertEquals([3], $operator->values());
        
        $operator = new Operator\NotEqual(new Operand\Value(2), new Operand\Column("id"));
        $this->assertEquals("? <> `id`", $operator->prepare());
        $this->assertEquals([2], $operator->values());
        
        $operator = new Operator\NotEqual(new Operand\Column("parent_id"), new Operand\Column("id"));
        $this->assertEquals("`parent_id` <> `id`", $operator->prepare());
        $this->assertEquals([], $operator->values());
    }
    
    public function testLt() {
        $operator = new Operator\Lt(new Operand\Value(1), new Operand\Value(2));
        $this->assertEquals("? < ?", $operator->prepare());
        $this->assertEquals([1, 2], $operator->values());
        
        $operator = new Operator\Lt(new Operand\Column("id"), new Operand\Value(3));
        $this->assertEquals("`id` < ?", $operator->prepare());
        $this->assertEquals([3], $operator->values());
        
        $operator = new Operator\Lt(new Operand\Value(2), new Operand\Column("id"));
        $this->assertEquals("? < `id`", $operator->prepare());
        $this->assertEquals([2], $operator->values());
        
        $operator = new Operator\Lt(new Operand\Column("parent_id"), new Operand\Column("id"));
        $this->assertEquals("`parent_id` < `id`", $operator->prepare());
        $this->assertEquals([], $operator->values());
    }
    
    public function testLte() {
        $operator = new Operator\Lte(new Operand\Value(1), new Operand\Value(2));
        $this->assertEquals("? <= ?", $operator->prepare());
        $this->assertEquals([1, 2], $operator->values());
        
        $operator = new Operator\Lte(new Operand\Column("id"), new Operand\Value(3));
        $this->assertEquals("`id` <= ?", $operator->prepare());
        $this->assertEquals([3], $operator->values());
        
        $operator = new Operator\Lte(new Operand\Value(2), new Operand\Column("id"));
        $this->assertEquals("? <= `id`", $operator->prepare());
        $this->assertEquals([2], $operator->values());
        
        $operator = new Operator\Lte(new Operand\Column("parent_id"), new Operand\Column("id"));
        $this->assertEquals("`parent_id` <= `id`", $operator->prepare());
        $this->assertEquals([], $operator->values());
    }
    
    public function testGt() {
        $operator = new Operator\Gt(new Operand\Value(1), new Operand\Value(2));
        $this->assertEquals("? > ?", $operator->prepare());
        $this->assertEquals([1, 2], $operator->values());
        
        $operator = new Operator\Gt(new Operand\Column("id"), new Operand\Value(3));
        $this->assertEquals("`id` > ?", $operator->prepare());
        $this->assertEquals([3], $operator->values());
        
        $operator = new Operator\Gt(new Operand\Value(2), new Operand\Column("id"));
        $this->assertEquals("? > `id`", $operator->prepare());
        $this->assertEquals([2], $operator->values());
        
        $operator = new Operator\Gt(new Operand\Column("parent_id"), new Operand\Column("id"));
        $this->assertEquals("`parent_id` > `id`", $operator->prepare());
        $this->assertEquals([], $operator->values());
    }
    
    public function testGte() {
        $operator = new Operator\Gte(new Operand\Value(1), new Operand\Value(2));
        $this->assertEquals("? >= ?", $operator->prepare());
        $this->assertEquals([1, 2], $operator->values());
        
        $operator = new Operator\Gte(new Operand\Column("id"), new Operand\Value(3));
        $this->assertEquals("`id` >= ?", $operator->prepare());
        $this->assertEquals([3], $operator->values());
        
        $operator = new Operator\Gte(new Operand\Value(2), new Operand\Column("id"));
        $this->assertEquals("? >= `id`", $operator->prepare());
        $this->assertEquals([2], $operator->values());
        
        $operator = new Operator\Gte(new Operand\Column("parent_id"), new Operand\Column("id"));
        $this->assertEquals("`parent_id` >= `id`", $operator->prepare());
        $this->assertEquals([], $operator->values());
    }
    
    public function testLike() {
        $operator = new Operator\Like(new Operand\Column("name"), new Operand\Value("%van%"));
        $this->assertEquals("`name` LIKE ?", $operator->prepare());
        $this->assertEquals(["%van%"], $operator->values());
        
        $operator = new Operator\Like(new Operand\Column("name"), new Operand\Column("name2"));
        $this->assertEquals("`name` LIKE `name2`", $operator->prepare());
        $this->assertEquals([], $operator->values());
        
        $operator = new Operator\Like(new Operand\Value("Ivanov"), new Operand\Value("%van%"));
        $this->assertEquals("? LIKE ?", $operator->prepare());
        $this->assertEquals(["Ivanov", "%van%"], $operator->values());
    }
    
    public function testIs() {
        $operator = new Operator\Is(new Operand\Value(1), new Operand\Value(true));
        $this->assertEquals("? IS ?", $operator->prepare());
        $this->assertEquals([1, true], $operator->values());
        
        $operator = new Operator\Is(new Operand\Column("deleted"), new Operand\Value(true));
        $this->assertEquals("`deleted` IS ?", $operator->prepare());
        $this->assertEquals([true], $operator->values());
    }
    
    public function testIsNot() {
        $operator = new Operator\IsNot(new Operand\Value(1), new Operand\Value(true));
        $this->assertEquals("? IS NOT ?", $operator->prepare());
        $this->assertEquals([1, true], $operator->values());
        
        $operator = new Operator\IsNot(new Operand\Column("deleted"), new Operand\Value(true));
        $this->assertEquals("`deleted` IS NOT ?", $operator->prepare());
        $this->assertEquals([true], $operator->values());
    }
    
    public function testIsNull() {
        $operator = new Operator\IsNull(new Operand\Value(1));
        $this->assertEquals("? IS NULL", $operator->prepare());
        $this->assertEquals([1], $operator->values());
        
        $operator = new Operator\IsNull(new Operand\Column("id"));
        $this->assertEquals("`id` IS NULL", $operator->prepare());
        $this->assertEquals([], $operator->values());
    }
    
    public function testIsNotNull() {
        $operator = new Operator\IsNotNull(new Operand\Value(1));
        $this->assertEquals("? IS NOT NULL", $operator->prepare());
        $this->assertEquals([1], $operator->values());
        
        $operator = new Operator\IsNotNull(new Operand\Column("id"));
        $this->assertEquals("`id` IS NOT NULL", $operator->prepare());
        $this->assertEquals([], $operator->values());
    }
    
    public function testBetween() {
        $operator = new Operator\Between(new Operand\Value(13), new Operand\Interval(1, 10));
        $this->assertEquals("? BETWEEN ? AND ?", $operator->prepare());
        $this->assertEquals([13, 1, 10], $operator->values());
        
        $operator = new Operator\Between(new Operand\Column("id"), new Operand\Interval(1, 10));
        $this->assertEquals("`id` BETWEEN ? AND ?", $operator->prepare());
        $this->assertEquals([1, 10], $operator->values());
        
        $min = new Operand\Column("min");
        $max = new Operand\Column("max");
        $operator = new Operator\Between(new Operand\Column("id"), new Operand\Interval($min, $max));
        $this->assertEquals("`id` BETWEEN `min` AND `max`", $operator->prepare());
        $this->assertEquals([], $operator->values());
    }
    
    public function testIn() {
        $operator = new Operator\In(new Operand\Value(13), new Operand\Enum([1, 2, 3, 4]));
        $this->assertEquals("? IN (?, ?, ?, ?)", $operator->prepare());
        $this->assertEquals([13, 1, 2, 3, 4], $operator->values());
        
        $operator = new Operator\In(new Operand\Column("id"), new Operand\Enum([1, 2, 3, 4]));
        $this->assertEquals("`id` IN (?, ?, ?, ?)", $operator->prepare());
        $this->assertEquals([1, 2, 3, 4], $operator->values());
    }
    
    public function testLogicalNot() {
        $operator = new Operator\LogicalNot(new Operand\Value(3));
        $this->assertEquals("NOT ?", $operator->prepare());
        $this->assertEquals([3], $operator->values());
        
        $operator = new Operator\LogicalNot(new Operand\Column("alive"));
        $this->assertEquals("NOT `alive`", $operator->prepare());
        $this->assertEquals([], $operator->values());
        
        $operator1 = new Operator\In(new Operand\Value(13), new Operand\Enum([1, 2, 3, 4]));
        $operator = new Operator\LogicalNot($operator1);
        $this->assertEquals("NOT (? IN (?, ?, ?, ?))", $operator->prepare());
        $this->assertEquals([13, 1, 2, 3, 4], $operator->values());
    }
    
    public function testLogicalAnd() {
        $operator = new Operator\LogicalAnd([new Operand\Value(true), new Operand\Value(false)]);
        $this->assertEquals("? AND ?", $operator->prepare());
        $this->assertEquals([true, false], $operator->values());
        
        $operator = new Operator\LogicalAnd([new Operand\Column("cond1"), new Operand\Column("cond2"), new Operand\Column("cond3")]);
        $this->assertEquals("`cond1` AND `cond2` AND `cond3`", $operator->prepare());
        $this->assertEquals([], $operator->values());
        
        $operator1 = new Operator\In(new Operand\Column("id"), new Operand\Enum([1, 2, 3, 4]));
        $operator2 = new Operator\Between(new Operand\Column("id"), new Operand\Interval(1, 10));
        $operator = new Operator\LogicalAnd([$operator2, $operator1]);
        $this->assertEquals("(`id` BETWEEN ? AND ?) AND (`id` IN (?, ?, ?, ?))", $operator->prepare());
        $this->assertEquals([1, 10, 1, 2, 3, 4], $operator->values());
    }
    
    public function testLogicalOr() {
        $operator = new Operator\LogicalOr([new Operand\Value(true), new Operand\Value(false)]);
        $this->assertEquals("? OR ?", $operator->prepare());
        $this->assertEquals([true, false], $operator->values());
        
        $operator = new Operator\LogicalOr([new Operand\Column("cond1"), new Operand\Column("cond2"), new Operand\Column("cond3")]);
        $this->assertEquals("`cond1` OR `cond2` OR `cond3`", $operator->prepare());
        $this->assertEquals([], $operator->values());
        
        $operator1 = new Operator\In(new Operand\Column("id"), new Operand\Enum([1, 2, 3, 4]));
        $operator2 = new Operator\Between(new Operand\Column("id"), new Operand\Interval(1, 10));
        $operator = new Operator\LogicalOr([$operator2, $operator1]);
        $this->assertEquals("(`id` BETWEEN ? AND ?) OR (`id` IN (?, ?, ?, ?))", $operator->prepare());
        $this->assertEquals([1, 10, 1, 2, 3, 4], $operator->values());
    }
    
}
