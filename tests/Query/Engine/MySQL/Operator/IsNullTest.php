<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDBTest\Query\Engine\MySQL\Operator;

use RSDB\Query\Engine\MySQL\Operator;
use RSDBTest;

class IsNullTest extends RSDBTest\Base {
    
    public function testSimpleValues() {
        $stmt = new Operator\IsNull(123);
        $this->assertSame("? IS NULL", $stmt->prepare());
        $this->assertSame([123], $stmt->values());
    }
    
    public function testComplexValues() {
        $stmt = new Operator\IsNull(new Operator\Column("id"));
        $this->assertSame("`id` IS NULL", $stmt->prepare());
        $this->assertSame([], $stmt->values());
    }
    
}
