<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Statement;

use RsORM\Query\Engine\MySQL\Condition;
use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Engine\MySQL\Clause;
use RsORM\Query\Engine\MySQL\Statement;
use RsORMTest;

class DeleteTest extends RsORMTest\Base {

    public function test() {
        $table = new Clause\From(new Argument\Table("table"));
        $filter = new Clause\Filter(new Condition\LogicalOr([
            new Condition\Equal(new Argument\Column("id"), new Argument\Value(10)),
            new Condition\Equal(new Argument\Column("id"), new Argument\Value(20)),
        ]));
        $order = new Clause\Order([new Argument\Desc(new Argument\Column("id"))]);
        $limit = new Clause\Limit(new Argument\Value(5), new Argument\Value(10));
        $stmt = new Statement\Delete($table, $filter, $order, $limit);
        $this->assertSame("DELETE FROM `table` WHERE (`id` = ?) OR (`id` = ?) ORDER BY `id` DESC LIMIT ?, ?", $stmt->prepare());
        $this->assertSame([10, 20, 5, 10], $stmt->values());
    }
    
}
