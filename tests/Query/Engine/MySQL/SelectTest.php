<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Expression;

use RsORM\Query\Engine\MySQL\Expression;
use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Engine\MySQL\Clause;
use RsORM\Query\Engine\MySQL\Statement;
use RsORMTest;

class SelectTest extends RsORMTest\Base {

    public function test() {
        $fields = new Clause\Fields([
            new Argument\Field(new Argument\Column("id")),
            new Argument\Field(new Argument\Column("name")),
        ]);
        $table = new Clause\From(new Argument\Table("table"));
        $filter = new Clause\Filter(new Expression\LogicalOr([
            new Expression\Equal(new Argument\Column("id"), new Argument\Value(10)),
            new Expression\Equal(new Argument\Column("id"), new Argument\Value(20)),
        ]));
        $stmt = new Statement\Select($fields, $table, $filter);
        $this->assertSame("SELECT `id`, `name` FROM `table` WHERE (`id` = ?) OR (`id` = ?)", $stmt->prepare());
        $this->assertSame([10, 20], $stmt->values());
    }
    
}
