<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDBTest\Query\Engine\MySQL\Operator;

use RSDB\Query\Engine\MySQL\Operator;
use RSDBTest;

class IsNotNullTest extends RSDBTest\Base {
    
    public function testSimpleValues() {
        $stmt = new Operator\IsNotNull(123);
        $this->assertSame("? IS NOT NULL", $stmt->prepare());
        $this->assertSame([123], $stmt->values());
    }
    
    public function testComplexValues() {
        $stmt = new Operator\IsNotNull(new Operator\Column("id"));
        $this->assertSame("`id` IS NOT NULL", $stmt->prepare());
        $this->assertSame([], $stmt->values());
    }
    
}
