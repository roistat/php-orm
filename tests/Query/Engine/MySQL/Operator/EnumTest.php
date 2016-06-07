<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDBTest\Query\Engine\MySQL\Operator;

use RSDB\Query\Engine\MySQL\Operator;
use RSDBTest;

class EnumTest extends RSDBTest\Base {
    
    public function testSimpleValues() {
        $enum = new Operator\Enum([1, 2, 3, 4]);
        $this->assertSame("?, ?, ?, ?", $enum->prepare());
        $this->assertSame([1, 2, 3, 4], $enum->values());
    }
    
    public function testComplexValues() {
        $enum = new Operator\Enum([123, "qwe", new Operator\Column("field"), new Operator\Value(3.14)]);
        $this->assertSame("?, ?, `field`, ?", $enum->prepare());
        $this->assertSame([123, "qwe", 3.14], $enum->values());
    }
    
    public function testSingleValue() {
        $enum = new Operator\Enum([123]);
        $this->assertSame("?", $enum->prepare());
        $this->assertSame([123], $enum->values());
    }
    
}
