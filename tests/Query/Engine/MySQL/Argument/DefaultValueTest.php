<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Argument;

use RsORMTest;
use RsORM\Query\Engine\MySQL\Argument;

class DefaultValueTest extends RsORMTest\Base {

    public function test() {
        $value = new Argument\DefaultValue();
        $this->assertSame("DEFAULT", $value->prepare());
    }
    
}
