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
        $operator = new Operator\Equal(1, 2);
        $this->assertEquals("? = ?", $operator->prepare());
        $operator = new Operator\Equal(new Operand\Column("id"), 2);
        $this->assertEquals("`id` = ?", $operator->prepare());
        $operator = new Operator\Equal(2, new Operand\Column("id"));
        $this->assertEquals("? = `id`", $operator->prepare());
        //$this->assertEquals([13], $operator->getParameters());
    }
    
}
