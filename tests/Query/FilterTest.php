<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDBTest\Query;

use RSDB\Query\Filter;
use RSDBTest;

class FilterTest extends RSDBTest\Base {
    
    public function testEqual() {
        $filter = new Filter\Equal("id", 13);
        $this->assertEquals("`id` = ?", $filter->prepare());
        $this->assertEquals([13], $filter->getParameters());
    }
    
    public function testNotEqual() {
        $filter = new Filter\NotEqual("id", 13);
        $this->assertEquals("`id` <> ?", $filter->prepare());
        $this->assertEquals([13], $filter->getParameters());
    }
    
    public function testGt() {
        $filter = new Filter\Gt("id", 3);
        $this->assertEquals("`id` > ?", $filter->prepare());
        $this->assertEquals([3], $filter->getParameters());
    }
    
    public function testGte() {
        $filter = new Filter\Gte("id", 3);
        $this->assertEquals("`id` >= ?", $filter->prepare());
        $this->assertEquals([3], $filter->getParameters());
    }
    
    public function testLt() {
        $filter = new Filter\Lt("id", 10);
        $this->assertEquals("`id` < ?", $filter->prepare());
        $this->assertEquals([10], $filter->getParameters());
    }
    
    public function testLte() {
        $filter = new Filter\Lte("id", 10);
        $this->assertEquals("`id` <= ?", $filter->prepare());
        $this->assertEquals([10], $filter->getParameters());
    }
    
    public function testIsNull() {
        $filter = new Filter\IsNull("id");
        $this->assertEquals("`id` IS NULL", $filter->prepare());
        $this->assertEquals([], $filter->getParameters());
    }
    
    public function testIsNotNull() {
        $filter = new Filter\IsNotNull("id");
        $this->assertEquals("`id` IS NOT NULL", $filter->prepare());
        $this->assertEquals([], $filter->getParameters());
    }
    
    public function testBetween() {
        $filter = new Filter\Between("id", 1, 10);
        $this->assertEquals("`id` BETWEEN ? AND ?", $filter->prepare());
        $this->assertEquals([1, 10], $filter->getParameters());
    }
    
    public function testLike() {
        $filter = new Filter\Like("email", "%gmail%");
        $this->assertEquals("`email` LIKE ?", $filter->prepare());
        $this->assertEquals(["%gmail%"], $filter->getParameters());
    }
    
    public function testIn() {
        $filter = new Filter\In("id", [1, 2, 3, 4]);
        $this->assertEquals("`id` IN (?, ?, ?, ?)", $filter->prepare());
        $this->assertEquals([1, 2, 3, 4], $filter->getParameters());
    }
    
    public function testLogicalNot() {
        $filter = new Filter\Equal("id", 13);
        $expr = new Filter\LogicalNot($filter);
        $this->assertEquals("NOT (`id` = ?)", $expr->prepare());
        $this->assertEquals([13], $expr->getParameters());
        $expr2 = new Filter\LogicalNot($expr);
        $this->assertEquals("NOT (NOT (`id` = ?))", $expr2->prepare());
        $this->assertEquals([13], $expr2->getParameters());
    }
    
    public function testLogicalAnd() {
        $a = new Filter\Equal("alive", 1);
        $b = new Filter\Gte("age", 18);
        $c = new Filter\Lt("age", 27);
        $d = new Filter\LogicalAnd([$b, $c, $a]);
        $this->assertEquals("(`age` >= ?) AND (`age` < ?) AND (`alive` = ?)", $d->prepare());
        $this->assertEquals([18, 27, 1], $d->getParameters());
        $e = new Filter\Like("last_name", "Iva%");
        $f = new Filter\In("city", ["Tula", "Vladivostok", "Novosibirsk"]);
        $g = new Filter\LogicalAnd([$e, $f]);
        $h = new Filter\LogicalAnd([$g, $d]);
        $this->assertEquals("((`last_name` LIKE ?) AND (`city` IN (?, ?, ?))) AND ((`age` >= ?) AND (`age` < ?) AND (`alive` = ?))", $h->prepare());
        $this->assertEquals(["Iva%", "Tula", "Vladivostok", "Novosibirsk", 18, 27, 1], $h->getParameters());
    }
    
    public function testLogicalOr() {
        $a = new Filter\Equal("alive", 1);
        $b = new Filter\Gte("age", 18);
        $c = new Filter\Lt("age", 27);
        $d = new Filter\LogicalOr([$b, $c, $a]);
        $this->assertEquals("(`age` >= ?) OR (`age` < ?) OR (`alive` = ?)", $d->prepare());
        $this->assertEquals([18, 27, 1], $d->getParameters());
        $e = new Filter\Like("last_name", "Iva%");
        $f = new Filter\In("city", ["Tula", "Vladivostok", "Novosibirsk"]);
        $g = new Filter\LogicalOr([$e, $f]);
        $h = new Filter\LogicalOr([$g, $d]);
        $this->assertEquals("((`last_name` LIKE ?) OR (`city` IN (?, ?, ?))) OR ((`age` >= ?) OR (`age` < ?) OR (`alive` = ?))", $h->prepare());
        $this->assertEquals(["Iva%", "Tula", "Vladivostok", "Novosibirsk", 18, 27, 1], $h->getParameters());
    }
    
}
