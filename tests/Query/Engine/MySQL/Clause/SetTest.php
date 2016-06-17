<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Clause;

use RsORMTest;
use RsORM\Query\Engine\MySQL\Clause;
use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Engine\MySQL\Condition;

class SetTest extends RsORMTest\Base {

    public function test() {
        $values = new Clause\Set([
            new Condition\Equal(new Argument\Column("id"), new Argument\Value(1)),
            new Condition\Equal(new Argument\Column("name"), new Argument\Value("Mike")),
            new Condition\Equal(new Argument\Column("qwerty"), new Argument\NullValue()),
        ]);
        $this->assertSame("SET `id` = ?, `name` = ?, `qwerty` = NULL", $values->prepare());
        $this->assertSame([1, "Mike"], $values->values());
    }
    
}
