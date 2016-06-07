<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDBTest\Query\Engine\MySQL\Operator;

use RSDB\Query\Engine\MySQL\Operator;
use RSDBTest;

class InTest extends RSDBTest\Base {
    
    public function testSimpleValues() {
        $stmt = new Operator\In(10, new Operator\Enum([1, 10, 100]));
        $this->assertSame("? IN (?, ?, ?)", $stmt->prepare());
        $this->assertSame([10, 1, 10, 100], $stmt->values());
    }
    
    public function testComplexValues() {
        $stmt = new Operator\In(new Operator\Column("id"), new Operator\Enum([1, 10, 100]));
        $this->assertSame("`id` IN (?, ?, ?)", $stmt->prepare());
        $this->assertSame([1, 10, 100], $stmt->values());
    }
    
}
