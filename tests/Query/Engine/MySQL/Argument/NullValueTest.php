<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Argument;

use RsORMTest;
use RsORM\Query\Engine\MySQL\Argument;

class NullValueTest extends RsORMTest\Base {

    public function test() {
        $value = new Argument\NullValue();
        $this->assertSame("NULL", $value->prepare());
    }
    
}
