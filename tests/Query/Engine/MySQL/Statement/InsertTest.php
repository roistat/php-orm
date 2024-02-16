<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Statement;

use RsORM\Query\Engine\MySQL\Condition;
use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Engine\MySQL\Clause;
use RsORM\Query\Engine\MySQL\Statement;
use RsORM\Query\Engine\MySQL\Flag;
use RsORMTest;

class InsertTest extends RsORMTest\Base {

    public function test() {
        $columns = new Clause\Columns([
            new Argument\Column("id"),
            new Argument\Column("name"),
            new Argument\Column("qwe"),
        ]);
        $table = new Clause\Into(new Argument\Table("table"));
        $values = new Clause\Values([
            new Argument\Value(1),
            new Argument\Value("Mike"),
            new Argument\NullValue(),
        ]);
        $flags = new Clause\Flags([
            new Flag\Delayed(),
            new Flag\Ignore(),
        ]);
        $returning = new Clause\Returning(new Argument\Column("id"));
        $stmt = new Statement\Insert($table, $values, $columns, $returning, $flags);
        $this->assertSame("INSERT DELAYED IGNORE INTO table (id, name, qwe) VALUES (?, ?, NULL) RETURNING id", $stmt->prepare());
        $this->assertSame([1, "Mike"], $stmt->values());
    }
    
}
