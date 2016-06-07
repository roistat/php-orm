<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDBTest\Query\Engine\MySQL\Operator;

use RSDB\Query\Engine\MySQL\Operator;
use RSDBTest;

class ValueTest extends RSDBTest\Base {
    
    public function testInt() {
        $val = new Operator\Value(123);
        $this->assertSame("?", $val->prepare());
        $this->assertSame([123], $val->values());
    }
    
    public function testFloat() {
        $val = new Operator\Value(3.14);
        $this->assertSame("?", $val->prepare());
        $this->assertSame([3.14], $val->values());
    }
    
    public function testString() {
        $val = new Operator\Value("qwe");
        $this->assertSame("?", $val->prepare());
        $this->assertSame(["qwe"], $val->values());
    }
    
    public function testBool() {
        $val = new Operator\Value(true);
        $this->assertSame("?", $val->prepare());
        $this->assertSame([1], $val->values());
        $val = new Operator\Value(false);
        $this->assertSame("?", $val->prepare());
        $this->assertSame([0], $val->values());
    }
    
}
