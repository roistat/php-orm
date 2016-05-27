<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDBTest\Query;

use RSDB\Query\Filter;

class FilterTest extends \PHPUnit_Framework_TestCase {
    
    public function testEqual() {
        $filter = new Filter\Equal(["qwe"]);
        $this->assertEquals($filter->prepare(), "qwe = :qwe");
        $filter = new Filter\Equal(["qwe", ":asd"]);
        $this->assertEquals($filter->prepare(), "qwe = :asd");
    }
    
    public function testNotEqual() {
        $filter = new Filter\NotEqual(["qwe"]);
        $this->assertEquals($filter->prepare(), "qwe <> :qwe");
        $filter = new Filter\NotEqual(["qwe", ":asd"]);
        $this->assertEquals($filter->prepare(), "qwe <> :asd");
    }
    
    public function testGt() {
        $filter = new Filter\Gt(["qwe"]);
        $this->assertEquals($filter->prepare(), "qwe > :qwe");
        $filter = new Filter\Gt(["qwe", ":asd"]);
        $this->assertEquals($filter->prepare(), "qwe > :asd");
    }
    
    public function testGte() {
        $filter = new Filter\Gte(["qwe"]);
        $this->assertEquals($filter->prepare(), "qwe >= :qwe");
        $filter = new Filter\Gte(["qwe", ":asd"]);
        $this->assertEquals($filter->prepare(), "qwe >= :asd");
    }
    
    public function testLt() {
        $filter = new Filter\Lt(["qwe"]);
        $this->assertEquals($filter->prepare(), "qwe < :qwe");
        $filter = new Filter\Lt(["qwe", ":asd"]);
        $this->assertEquals($filter->prepare(), "qwe < :asd");
    }
    
    public function testLte() {
        $filter = new Filter\Lte(["qwe"]);
        $this->assertEquals($filter->prepare(), "qwe <= :qwe");
        $filter = new Filter\Lte(["qwe", ":asd"]);
        $this->assertEquals($filter->prepare(), "qwe <= :asd");
    }
    
    public function testIsNull() {
        $filter = new Filter\IsNull(["qwe"]);
        $this->assertEquals($filter->prepare(), "qwe IS NULL");
    }
    
    public function testIsNotNull() {
        $filter = new Filter\IsNotNull(["qwe"]);
        $this->assertEquals($filter->prepare(), "qwe IS NOT NULL");
    }
    
    public function testBetween() {
        $filter = new Filter\Between(["qwe", ":min", ":max"]);
        $this->assertEquals($filter->prepare(), "qwe BETWEEN :min AND :max");
    }
    
    public function testNot() {
        $filter = new Filter\Not(["qwe"]);
        $this->assertEquals($filter->prepare(), "NOT qwe");
        $filter2 = new Filter\Gt(["qwe", "asd"]);
        $filter = new Filter\Not([$filter2]);
        $this->assertEquals($filter->prepare(), "NOT (qwe > asd)");
    }
    
    public function testLike() {
        $filter = new Filter\Like(["qwe", "ewq"]);
        $this->assertEquals($filter->prepare(), "qwe LIKE ewq");
    }
    
    public function testIn() {
        $filter = new Filter\In(["id", [1, 2, 3, 4]]);
        $this->assertEquals($filter->prepare(), "id IN (1, 2, 3, 4)");
    }
    
    public function testAnd() {
        $filter = new Filter\FilterAnd(["qwe", "asd"]);
        $this->assertEquals($filter->prepare(), "qwe AND asd");
        $filter = new Filter\FilterAnd(["qwe", "asd", "zxc"]);
        $this->assertEquals($filter->prepare(), "qwe AND asd AND zxc");
        $filter1 = new Filter\Gt(["age", 18]);
        $filter2 = new Filter\Lt(["age", 150]);
        $filter = new Filter\FilterAnd([$filter1, $filter2]);
        $this->assertEquals($filter->prepare(), "(age > 18) AND (age < 150)");
    }
    
    public function testOr() {
        $filter = new Filter\FilterOr(["qwe", "asd"]);
        $this->assertEquals($filter->prepare(), "qwe OR asd");
        $filter = new Filter\FilterOr(["qwe", "asd", "zxc"]);
        $this->assertEquals($filter->prepare(), "qwe OR asd OR zxc");
        $filter1 = new Filter\Gt(["age", 18]);
        $filter2 = new Filter\Lt(["age", 150]);
        $filter = new Filter\FilterOr([$filter1, $filter2]);
        $this->assertEquals($filter->prepare(), "(age > 18) OR (age < 150)");
    }
    
}
