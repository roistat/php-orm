<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDBTest\Query\Engine\MySQL;

use RSDB\Query\Engine\MySQL\Operator;
use RSDB\Query\Engine\MySQL\Operand;
use RSDBTest;

class OperatorTest extends RSDBTest\Base {
    
    public function testEqual() {
        $operator = new Operator\Equal(new Operand\Value(1), new Operand\Value(2));
        $this->assertEquals("? = ?", $operator->prepare());
        $operator = new Operator\Equal(new Operand\Column("id"), new Operand\Value(3));
        $this->assertEquals("`id` = ?", $operator->prepare());
        $operator = new Operator\Equal(new Operand\Value(2), new Operand\Column("id"));
        $this->assertEquals("? = `id`", $operator->prepare());
    }
    
}
