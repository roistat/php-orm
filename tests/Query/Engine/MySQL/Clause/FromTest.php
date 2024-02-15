<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Clause;

use RsORMTest;
use RsORM\Query\Engine\MySQL\Clause;
use RsORM\Query\Engine\MySQL\Argument;

class FromTest extends RsORMTest\Base {

    public function test() {
        $from = new Clause\From(new Argument\Table("table"));
        $this->assertSame("FROM table", $from->prepare());
        $this->assertSame([], $from->values());
    }
    
}
