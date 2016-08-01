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
        $stmt = Builder::delete()
                ->table("table")
                ->build();
        $this->assertSame("DELETE FROM `table`", $stmt->prepare());
        $this->assertSame([], $stmt->values());
    }
    
    public function testFull() {
        $filter = Builder::filter()
                ->eq("type", 123);
        $stmt = Builder::delete()
                ->table("table")
                ->limit(10, 20)
                ->order("flag")
                ->where($filter)
                ->flagHighPriority()
                ->build();
        $this->assertSame("DELETE HIGH_PRIORITY FROM `table` WHERE `type` = ? ORDER BY `flag` LIMIT ?, ?", $stmt->prepare());
        $this->assertSame([123, 10, 20], $stmt->values());
    }
}
