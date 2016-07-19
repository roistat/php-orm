<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Builder;

use RsORMTest;
use RsORM\Query\Engine\MySQL\Builder;
use RsORM\Query\Engine\MySQL\Flag;

class DeleteTest extends RsORMTest\Base {
    
    public function testShort() {
        $query = Builder::delete()
                ->table("table");
        $stmt = $query->build();
        $this->assertSame("DELETE FROM `table`", $stmt->prepare());
        $this->assertSame([], $stmt->values());
    }
    
    public function testFull() {
        $filter = Builder::filter()
                ->eq("type", 123);
        $query = Builder::delete()
                ->table("table")
                ->limit(10, 20)
                ->order("flag")
                ->where($filter)
                ->flags([new Flag\HighPriority()]);
        $query->table("table");
        $stmt = $query->build();
        $this->assertSame("DELETE HIGH_PRIORITY FROM `table` WHERE `type` = ? ORDER BY `flag` LIMIT ?, ?", $stmt->prepare());
        $this->assertSame([123, 10, 20], $stmt->values());
    }
}
