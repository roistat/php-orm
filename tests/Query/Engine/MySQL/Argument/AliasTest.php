<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Argument;

use RsORMTest;
use RsORM\Query\Engine\MySQL\Argument;

class AliasTest extends RsORMTest\Base {

    public function test() {
        $alias = new Argument\Alias("uid");
        $this->assertSame("`uid`", $alias->prepare());
    }
    
}
