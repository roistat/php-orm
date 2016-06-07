<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDBTest\Query\Engine\MySQL\Operator;

use RSDB\Query\Engine\MySQL\Operator;
use RSDBTest;

class LogicalAndTest extends RSDBTest\Base {
    
    public function testSimpleValues() {
        $stmt = new Operator\LogicalAnd([1, 2]);
        $this->assertSame("? AND ?", $stmt->prepare());
        $this->assertSame([1, 2], $stmt->values());
    }
    
    public function testComplexValues() {
        $stmt = new Operator\LogicalAnd([new Operator\Column("flag1"), new Operator\Column("flag2")]);
        $this->assertSame("`flag1` AND `flag2`", $stmt->prepare());
        $this->assertSame([], $stmt->values());
    }
    
    public function testComplexStmt() {
        $stmt1 = new Operator\In(new Operator\Column("id"), new Operator\Enum([1, 2, 3]));
        $stmt2 = new Operator\Equal(new Operator\Column("alive"), 1);
        $stmt = new Operator\LogicalAnd([$stmt2, $stmt1]);
        $this->assertSame("(`alive` = ?) AND (`id` IN (?, ?, ?))", $stmt->prepare());
        $this->assertSame([1, 1, 2, 3], $stmt->values());
    }
    
}
