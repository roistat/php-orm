<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Clause;

use RsORMTest;
use RsORM\Query\Engine\MySQL\Clause;
use RsORM\Query\Engine\MySQL\Argument;

class GroupTest extends RsORMTest\Base {

    public function test() {
        $group = new Clause\Group([
            new Argument\Column("id"),
            new Argument\Alias("last_name"),
            new Argument\Desc(new Argument\Column("order")),
        ]);
        $this->assertSame("GROUP BY `id`, `last_name`, `order` DESC", $group->prepare());
        $this->assertSame([], $group->values());
    }
    
}
