<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDBTest\Query\Engine\MySQL\Operator;

use RSDB\Query\Engine\MySQL\Operator;
use RSDBTest;

class EqualTest extends RSDBTest\Base {
    
    public function testSimpleValues() {
        $stmt = new Operator\Equal(12, 13);
        $this->assertSame("? = ?", $stmt->prepare());
        $this->assertSame([12,13], $stmt->values());
    }
    
    public function testComplexValues() {
        $stmt = new Operator\Equal(new Operator\Column("id"), new Operator\Column("uid"));
        $this->assertSame("`id` = `uid`", $stmt->prepare());
        $this->assertSame([], $stmt->values());
        
        $stmt = new Operator\Equal(new Operator\NullValue(), new Operator\NullValue());
        $this->assertSame("NULL = NULL", $stmt->prepare());
        $this->assertSame([], $stmt->values());
        
        $stmt = new Operator\Equal(new Operator\Column("name"), new Operator\Value("Mike"));
        $this->assertSame("`name` = ?", $stmt->prepare());
        $this->assertSame(["Mike"], $stmt->values());
        
        $stmt = new Operator\Equal(new Operator\Value("Mike"), new Operator\Column("name"));
        $this->assertSame("? = `name`", $stmt->prepare());
        $this->assertSame(["Mike"], $stmt->values());
    }
    
}
