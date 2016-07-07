<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query;

use RsORMTest;
use RsORM\Query\Builder;
use RsORM\Query\Engine\MySQL\Func;
use RsORM\Query\Engine\MySQL\Argument;

class BuilderTest extends RsORMTest\Base {
    
    public function test() {
        $filter1 = Builder::filter()
                ->eq("id", 3)
                ->eq("id", 4);
        $filter = Builder::filter()
                ->eq("id", 1)
                ->eq("id", 2, false)
                ->logicOr($filter1);
        $query = Builder::select(["id", "user", "pass"])
                ->funcCount("id", "num", true)
                ->from("users")
                ->where($filter)
                ->limit(10, 20)
                ->order("name", false)
                ->group("name")
                ->group("pass");
        $stmt = $query->build();
        $this->assertSame("SELECT `id`, `user`, `pass`, COUNT(DISTINCT `id`) AS `num` FROM `users` WHERE ((`id` = ?) AND (`id` != ?)) OR ((`id` = ?) AND (`id` = ?)) GROUP BY `name`, `pass` ORDER BY `name` DESC LIMIT ?, ?", $stmt->prepare());
        $this->assertSame([1, 2, 3, 4, 10, 20], $stmt->values());
    }
    
}
