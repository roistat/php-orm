<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDBTest\Query\Engine\MySQL\Operator;

use RSDB\Query\Engine\MySQL\Operator;
use RSDBTest;

class IsTest extends RSDBTest\Base {
    
    public function testSimpleValues() {
        $stmt = new Operator\Is(1, 1);
        $this->assertSame("? IS ?", $stmt->prepare());
        $this->assertSame([1, 1], $stmt->values());
    }
    
    public function testComplexValues() {
        $stmt = new Operator\Is(new Operator\Column("id"), new Operator\NullValue());
        $this->assertSame("`id` IS NULL", $stmt->prepare());
        $this->assertSame([], $stmt->values());
    }
    
}
