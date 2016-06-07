<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDBTest\Query\Engine\MySQL\Operator;

use RSDB\Query\Engine\MySQL\Operator;
use RSDBTest;

class IntervalTest extends RSDBTest\Base {
    
    public function testSimpleValues() {
        $interval = new Operator\Interval(10, 20);
        $this->assertSame("? AND ?", $interval->prepare());
        $this->assertSame([10, 20], $interval->values());
    }
    
    public function testComplexValues() {
        $interval = new Operator\Interval(new Operator\Column("min"), new Operator\Column("max"));
        $this->assertSame("`min` AND `max`", $interval->prepare());
        $this->assertSame([], $interval->values());
    }
    
}
