<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query;

use RsORM\Query;
use RsORM\Query\Engine\MySQL\Condition;
use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Engine\MySQL\Clause;
use RsORMTest;

class MySQLTest extends RsORMTest\Base {
    
    private $engine;
    
    protected function setUp() {
        $this->engine = new Query\Engine();
    }
    
    public function testSelect() {
        $fields = new Clause\Fields([
            new Argument\Field(new Argument\Column("id")),
            new Argument\Field(new Argument\Column("name")),
        ]);
        $table = new Clause\From(new Argument\Table("table"));
        $filter = new Clause\Filter(new Condition\LogicalOr([
            new Condition\Equal(new Argument\Column("id"), new Argument\Value(10)),
            new Condition\Equal(new Argument\Column("id"), new Argument\Value(20)),
        ]));
        $group = new Clause\Group([new Argument\Column("id")]);
        $having = new Clause\Having(new Condition\Equal(new Argument\Column("alive"), new Argument\Value(true)));
        $order = new Clause\Order([new Argument\Desc(new Argument\Column("id"))]);
        $limit = new Clause\Limit(new Argument\Value(5), new Argument\Value(10));
        $stmt = $this->engine->mysql()->select($fields, $table, $filter, $group, $having, $order, $limit);
        $this->assertSame("SELECT `id`, `name` FROM `table` WHERE (`id` = ?) OR (`id` = ?) GROUP BY `id` HAVING `alive` = ? ORDER BY `id` DESC LIMIT ?, ?", $stmt->prepare());
        $this->assertSame([10, 20, 1, 5, 10], $stmt->values());
    }
    
}
