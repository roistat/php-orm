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

class UpdateTest extends RsORMTest\Base {

    public function test() {
        $table = new Argument\Table("table");
        $set = new Clause\Set([
            new Condition\Equal(new Argument\Column("id"), new Argument\Value(1)),
            new Condition\Equal(new Argument\Column("name"), new Argument\Value("Mike")),
            new Condition\Equal(new Argument\Column("qwerty"), new Argument\NullValue()),
        ]);
        $filter = new Clause\Filter(new Condition\LogicalOr([
            new Condition\Equal(new Argument\Column("id"), new Argument\Value(10)),
            new Condition\Equal(new Argument\Column("id"), new Argument\Value(20)),
        ]));
        $order = new Clause\Order([new Argument\Desc(new Argument\Column("id"))]);
        $limit = new Clause\Limit(new Argument\Value(5), new Argument\Value(10));
        $stmt = new Statement\Update($table, $set, $filter, $order, $limit);
        $this->assertSame("UPDATE `table` SET `id` = ?, `name` = ?, `qwerty` = NULL WHERE (`id` = ?) OR (`id` = ?) ORDER BY `id` DESC LIMIT ?, ?", $stmt->prepare());
        $this->assertSame([1, "Mike", 10, 20, 5, 10], $stmt->values());
    }
    
}
