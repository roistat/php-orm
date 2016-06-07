<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDBTest\Query\Engine\MySQL\Operator;

use RSDB\Query\Engine\MySQL\Operator;
use RSDBTest;

class ColumnTest extends RSDBTest\Base {
    
    public function test() {
        $col = new Operator\Column("id");
        $this->assertSame("`id`", $col->prepare());
        $this->assertSame([], $col->values());
    }
    
}
