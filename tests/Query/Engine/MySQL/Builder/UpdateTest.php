<?php
/**
 * @author Yury Zyuzkevich <farengier@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Builder;

use RsORMTest;
use RsORM\Query\Engine\MySQL\Builder;

class UpdateTest extends RsORMTest\Base {
    
    public function test() {
        $query = new Builder\Update([
            "id"    => 1,
            "name"  => "Mike",
            "pass"  => "123456",
            "age"   => 123,
        ]);
        $query->table("table");
        $stmt = $query->build();
        $this->assertSame("UPDATE `table` SET `id` = ?, `name` = ?, `pass` = ?, `age` = ?", $stmt->prepare());
        $this->assertSame([1, "Mike", "123456", 123], $stmt->values());
    }
    
}
