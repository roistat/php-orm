<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Argument;

use RsORMTest;
use RsORM\Query\Engine\MySQL\Argument;

class ValueTest extends RsORMTest\Base {

    public function testInt() {
        $value = new Argument\Value(123);
        $this->assertSame("?", $value->prepare());
        $this->assertSame(123, $value->value());
    }
    
    public function testFloat() {
        $value = new Argument\Value(3.14);
        $this->assertSame("?", $value->prepare());
        $this->assertSame(3.14, $value->value());
    }
    
    public function testString() {
        $value = new Argument\Value("qwe");
        $this->assertSame("?", $value->prepare());
        $this->assertSame("qwe", $value->value());
    }
    
    public function testBoolean() {
        $value = new Argument\Value(true);
        $this->assertSame("?", $value->prepare());
        $this->assertSame(1, $value->value());
        
        $value = new Argument\Value(false);
        $this->assertSame("?", $value->prepare());
        $this->assertSame(0, $value->value());
    }
    
}
