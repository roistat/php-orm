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
        $table = new Clause\Table("table");
        $filter = new Clause\Filter("condition");
        $stmt = new Statement\Select($fields, $table, $filter);
        $this->assertSame("SELECT `id`, `name` FROM `table` WHERE `id` > ?", $stmt->prepare());
        $this->assertSame([10], $stmt->values());
    }
    
}
