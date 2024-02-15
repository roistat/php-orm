<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Argument;

use RsORMTest;
use RsORM\Query\Engine\MySQL\Argument;

class ColumnTest extends RsORMTest\Base {

    public function test() {
        $column = new Argument\Column("id");
        $this->assertSame("id", $column->prepare());
    }
    
}
