<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Argument;

use RsORMTest;
use RsORM\Query\Engine\MySQL\Argument;

class AnyTest extends RsORMTest\Base {

    public function test() {
        $any = new Argument\Any();
        $this->assertSame("*", $any->prepare());
    }
    
}
