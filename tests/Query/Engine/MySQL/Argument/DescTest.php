<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Argument;

use RsORMTest;
use RsORM\Query\Engine\MySQL\Argument;

class DescTest extends RsORMTest\Base {

    public function test() {
        $arg = new Argument\Desc(new Argument\Column("id"));
        $this->assertSame("`id` DESC", $arg->prepare());
    }
    
}
