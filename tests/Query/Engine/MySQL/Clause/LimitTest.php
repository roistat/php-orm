<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Clause;

use RsORMTest;
use RsORM\Query\Engine\MySQL\Clause;
use RsORM\Query\Engine\MySQL\Argument;

class LimitTest extends RsORMTest\Base {

    public function test() {
        $limit = new Clause\Limit(new Argument\Value(5), new Argument\Value(10));
        $this->assertSame("LIMIT ? OFFSET ?", $limit->prepare());
        $this->assertSame([5, 10], $limit->values());
    }
    
}
