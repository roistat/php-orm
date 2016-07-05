<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Clause;

use RsORMTest;
use RsORM\Query\Engine\MySQL\Clause;
use RsORM\Query\Engine\MySQL\Argument;

class ValuesTest extends RsORMTest\Base {

    public function test() {
        $values = new Clause\Values([
            new Argument\Value(123),
            new Argument\Value(3.14),
            new Argument\Value("qwe"),
            new Argument\Value(true),
            new Argument\Value(false),
            new Argument\NullValue(),
            new Argument\DefaultValue(),
        ]);
        $this->assertSame("VALUES (?, ?, ?, ?, ?, NULL, DEFAULT)", $values->prepare());
        $this->assertSame([123, 3.14, "qwe", 1, 0], $values->values());
    }
    
}
