<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Clause;

use RsORMTest;
use RsORM\Query\Engine\MySQL\Clause;
use RsORM\Query\Engine\MySQL\Argument;

class OrderTest extends RsORMTest\Base {

    public function test() {
        $order = new Clause\Order([
            new Argument\Column("id"),
            new Argument\Alias("last_name"),
            new Argument\Desc("order"),
        ]);
        $this->assertSame("ORDER BY `id`, `last_name`, `order` DESC", $order->prepare());
        $this->assertSame([], $order->values());
    }
    
}
