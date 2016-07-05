<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Clause;

use RsORMTest;
use RsORM\Query\Engine\MySQL\Clause;
use RsORM\Query\Engine\MySQL\Flag;

class FlagsTest extends RsORMTest\Base {

    public function test() {
        $flags = new Clause\Flags([
            new Flag\HighPriority(),
            new Flag\Distinct(),
        ]);
        $this->assertSame("HIGH_PRIORITY DISTINCT", $flags->prepare());
        $this->assertSame([], $flags->values());
    }
    
}
