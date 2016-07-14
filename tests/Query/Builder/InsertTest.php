<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Builder;

use RsORMTest;
use RsORM\Query\Builder;

class InsertTest extends RsORMTest\Base {
    
    public function test() {
        $query = new Builder\Insert([
            "id"    => 1,
            "name"  => "Mike",
            "pass"  => "123456",
            "age"   => 123,
        ]);
        $query->table("table");
        $stmt = $query->build();
        $this->assertSame("INSERT INTO `table` (`id`, `name`, `pass`, `age`) VALUES (?, ?, ?, ?)", $stmt->prepare());
        $this->assertSame([1, "Mike", "123456", 123], $stmt->values());
    }
}
