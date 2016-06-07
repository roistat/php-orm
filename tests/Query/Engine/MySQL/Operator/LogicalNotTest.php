<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDBTest\Query\Engine\MySQL\Operator;

use RSDB\Query\Engine\MySQL\Operator;
use RSDBTest;

class LogicalNotTest extends RSDBTest\Base {
    
    public function testSimpleValues() {
        $stmt = new Operator\LogicalNot(false);
        $this->assertSame("NOT ?", $stmt->prepare());
        $this->assertSame([0], $stmt->values());
    }
    
    public function testComplexValues() {
        $stmt = new Operator\LogicalNot(new Operator\Column("alive"));
        $this->assertSame("NOT `alive`", $stmt->prepare());
        $this->assertSame([], $stmt->values());
    }
    
    public function testComplexStmt() {
        $stmt0 = new Operator\Equal(new Operator\Column("alive"), 1);
        $stmt = new Operator\LogicalNot($stmt0);
        $this->assertSame("NOT (`alive` = ?)", $stmt->prepare());
        $this->assertSame([1], $stmt->values());
    }
    
}
