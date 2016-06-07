<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDBTest\Query\Engine\MySQL\Operator;

use RSDB\Query\Engine\MySQL\Operator;
use RSDBTest;

class LogicalOrTest extends RSDBTest\Base {
    
    public function testSimpleValues() {
        $stmt = new Operator\LogicalOr([1, 2]);
        $this->assertSame("? OR ?", $stmt->prepare());
        $this->assertSame([1, 2], $stmt->values());
    }
    
    public function testComplexValues() {
        $stmt = new Operator\LogicalOr([new Operator\Column("flag1"), new Operator\Column("flag2")]);
        $this->assertSame("`flag1` OR `flag2`", $stmt->prepare());
        $this->assertSame([], $stmt->values());
    }
    
    public function testComplexStmt() {
        $stmt1 = new Operator\In(new Operator\Column("id"), new Operator\Enum([1, 2, 3]));
        $stmt2 = new Operator\Equal(new Operator\Column("alive"), 1);
        $stmt = new Operator\LogicalOr([$stmt2, $stmt1]);
        $this->assertSame("(`alive` = ?) OR (`id` IN (?, ?, ?))", $stmt->prepare());
        $this->assertSame([1, 1, 2, 3], $stmt->values());
    }
    
}
