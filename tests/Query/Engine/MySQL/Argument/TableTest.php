<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Argument;

use RsORMTest;
use RsORM\Query\Engine\MySQL\Argument;

class TableTest extends RsORMTest\Base {

    public function test() {
        $table = new Argument\Table("table");
        $this->assertSame("table", $table->prepare());
    }
    
}
