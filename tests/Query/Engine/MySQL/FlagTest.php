<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL;

use RsORMTest;
use RsORM\Query\Engine\MySQL\Flag;

class FlagTest extends RsORMTest\Base {
    
    public function testDistinct() {
        $flag = new Flag\Distinct();
        $this->assertSame("DISTINCT", $flag->prepare());
    }
    
}
