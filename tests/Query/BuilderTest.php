<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query;

use RsORMTest;
use RsORM\Query\Builder;
use RsORM\Query\Engine\MySQL\Func;
use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Engine\MySQL\Flag;

class BuilderTest extends RsORMTest\Base {
    
    public function test() {
        $filter1 = Builder::filter()
                ->eq("id", 3)
                ->eq("id", 4);
        $filter = Builder::filter()
                ->eq("id", 1)
                ->eq("id", 2, false)
                ->logicOr($filter1);
        $having = Builder::filter()->eq("pos", 3);
        $query = Builder::select(["id", "user", "pass", Builder::funcCount("id", "num", true)])
                ->table("users")
                ->where($filter)
                ->limit(10, 20)
                ->order([Builder::Desc("name")])
                ->group(["name", "pass"])
                ->having($having)
                ->flags([new Flag\HighPriority()]);
        $stmt = $query->build();
        $this->assertSame("SELECT HIGH_PRIORITY `id`, `user`, `pass`, COUNT(DISTINCT `id`) AS `num` FROM `users` WHERE ((`id` = ?) AND (`id` != ?)) OR ((`id` = ?) AND (`id` = ?)) GROUP BY `name`, `pass` HAVING `pos` = ? ORDER BY `name` DESC LIMIT ?, ?", $stmt->prepare());
        $this->assertSame([1, 2, 3, 4, 3, 10, 20], $stmt->values());
    }
    
}
