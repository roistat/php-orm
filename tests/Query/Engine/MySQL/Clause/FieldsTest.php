<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Clause;

use RsORMTest;
use RsORM\Query\Engine\MySQL\Clause;
use RsORM\Query\Engine\MySQL\Argument;

class FieldsTest extends RsORMTest\Base {

    public function test() {
        $fields = new Clause\Fields([
            new Argument\Field(new Argument\Column("id")),
            new Argument\Field(new Argument\Column("name2"), new Argument\Alias("last_name")),
        ]);
        $this->assertSame("`id`, `name2` AS `last_name`", $fields->prepare());
        $this->assertSame([], $fields->values());
    }
    
}
