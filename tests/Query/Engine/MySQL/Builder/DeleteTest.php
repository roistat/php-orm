<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Builder;

use RsORMTest;
use RsORM\Query\Engine\MySQL\Builder;
use RsORM\Query\Engine\MySQL\Func;
use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Engine\MySQL\Flag;

class DeleteTest extends RsORMTest\Base {
    
    public function test() {
        $query = new Builder\Delete();
        $query->table("table");
        $stmt = $query->build();
        $this->assertSame("DELETE FROM `table`", $stmt->prepare());
        $this->assertSame([], $stmt->values());
    }
    
}
