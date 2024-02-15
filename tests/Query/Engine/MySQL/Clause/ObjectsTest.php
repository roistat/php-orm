<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Clause;

use RsORMTest;
use RsORM\Query\Engine\MySQL\Clause;
use RsORM\Query\Engine\MySQL\Argument;

class ObjectsTest extends RsORMTest\Base {

    public function test() {
        $objects = new Clause\Objects([
            new Argument\Field(new Argument\Column("id")),
            new Argument\Field(new Argument\Column("name2"), new Argument\Alias("last_name")),
        ]);
        $this->assertSame("id, name2 AS last_name", $objects->prepare());
        $this->assertSame([], $objects->values());
    }
    
}
