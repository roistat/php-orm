<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Clause;

use RsORMTest;
use RsORM\Query\Engine\MySQL\Clause;
use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Engine\MySQL\Operator;

class SetTest extends RsORMTest\Base {

    public function test() {
        $values = new Clause\Set([
            new Operator\Assign(new Argument\Column("id"), new Argument\Value(1)),
            new Operator\Assign(new Argument\Column("name"), new Argument\Value("Mike")),
            new Operator\Assign(new Argument\Column("qwerty"), new Argument\NullValue()),
            new Operator\Assign(new Argument\Column("asdfgh"), new Argument\DefaultValue()),
        ]);
        $this->assertSame("SET `id` = ?, `name` = ?, `qwerty` = NULL, `asdfgh` = DEFAULT", $values->prepare());
        $this->assertSame([1, "Mike"], $values->values());
    }
    
}
