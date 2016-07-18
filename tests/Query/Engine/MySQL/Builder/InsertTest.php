<?php
/**
 * @author Yury Zyuzkevich <farengier@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Builder;

use RsORMTest;
use RsORM\Query\Engine\MySQL\Builder;
use RsORM\Query\Engine\MySQL\Func;
use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Engine\MySQL\Flag;

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
