<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDBTest\Query\Engine\MySQL\Operator;

use RSDB\Query\Engine\MySQL\Operator;
use RSDBTest;

class BetweenTest extends RSDBTest\Base {
    
    public function testSimpleValues() {
        $stmt = new Operator\Between(10, new Operator\Interval(1, 100));
        $this->assertSame("? BETWEEN ? AND ?", $stmt->prepare());
        $this->assertSame([10, 1, 100], $stmt->values());
    }
    
    public function testComplexValues() {
        $stmt = new Operator\Between(new Operator\Column("id"), new Operator\Interval(1, 100));
        $this->assertSame("`id` BETWEEN ? AND ?", $stmt->prepare());
        $this->assertSame([1, 100], $stmt->values());
    }
    
}
