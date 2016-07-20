<?php
/**
 * @author Yury Zyuzkevich <farengier@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Builder;

use RsORMTest;
use RsORM\Query\Engine\MySQL\Builder;
use RsORM\Query\Engine\MySQL\Flag;

class InsertTest extends RsORMTest\Base {
    
    public function testShort() {
        $query = Builder::insert(["id" => 1, "name" => "Mike"])
                ->table("users");
        $stmt = $query->build();
        $this->assertSame("INSERT INTO `users` (`id`, `name`) VALUES (?, ?)", $stmt->prepare());
        $this->assertSame([1, "Mike"], $stmt->values());
    }
    
    public function testFull() {
        $query = Builder::insert(["id" => 1, "name" => "Mike"])
                ->table("users")
                ->flagHighPriority();
        $stmt = $query->build();
        $this->assertSame("INSERT HIGH_PRIORITY INTO `users` (`id`, `name`) VALUES (?, ?)", $stmt->prepare());
        $this->assertSame([1, "Mike"], $stmt->values());
    }
    
}
