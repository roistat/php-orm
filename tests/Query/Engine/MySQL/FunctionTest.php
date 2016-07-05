<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL;

use RsORMTest;
use RsORM\Query\Engine\MySQL\Func;
use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Engine\MySQL\Clause;

class FunctionTest extends RsORMTest\Base {
    
    public function testCount() {
        $func = new Func\Count(new Argument\Any());
        $this->assertSame("COUNT(*)", $func->prepare());
        $this->assertSame([], $func->values());
    }
    
    public function testCountDistinct() {
        $func = new Func\Count(new Argument\Column("id"), true);
        $this->assertSame("COUNT(DISTINCT `id`)", $func->prepare());
        $this->assertSame([], $func->values());
    }
    
    public function testAvg() {
        $func = new Func\Avg(new Argument\Column("balance"));
        $this->assertSame("AVG(`balance`)", $func->prepare());
        $this->assertSame([], $func->values());
    }
    
    public function testAvgDisinct() {
        $func = new Func\Avg(new Argument\Column("balance"), true);
        $this->assertSame("AVG(DISTINCT `balance`)", $func->prepare());
        $this->assertSame([], $func->values());
    }
    
    public function testSum() {
        $func = new Func\Sum(new Argument\Column("balance"));
        $this->assertSame("SUM(`balance`)", $func->prepare());
        $this->assertSame([], $func->values());
    }
    
    public function testSumDistinct() {
        $func = new Func\Sum(new Argument\Column("balance"), true);
        $this->assertSame("SUM(DISTINCT `balance`)", $func->prepare());
        $this->assertSame([], $func->values());
    }
    
    public function testConcat() {
        $func = new Func\Concat([
            new Argument\Value("prefix"),
            new Argument\Column("name"),
            new Argument\Value("postfix"),
        ]);
        $this->assertSame("CONCAT(?, `name`, ?)", $func->prepare());
        $this->assertSame(["prefix", "postfix"], $func->values());
    }
    
}
