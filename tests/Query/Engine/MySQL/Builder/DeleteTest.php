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
        $query = Builder::delete()
                ->table("table")
                ->flags([new Flag\HighPriority()]);
        $query->table("table");
        $stmt = $query->build();
        $this->assertSame("DELETE FROM `table`", $stmt->prepare());
        $this->assertSame([], $stmt->values());
    }
    
}
