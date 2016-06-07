<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDBTest\Query\Engine\MySQL\Operator;

use RSDB\Query\Engine\MySQL\Operator;
use RSDBTest;

class NullValueTest extends RSDBTest\Base {
    
    public function test() {
        $null = new Operator\NullValue();
        $this->assertSame("NULL", $null->prepare());
        $this->assertSame([], $null->values());
    }
    
}
