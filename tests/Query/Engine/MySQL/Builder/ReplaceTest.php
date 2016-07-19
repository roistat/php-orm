<?php
/**
 * @author Yury Zyuzkevich <farengier@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Builder;

use RsORMTest;
use RsORM\Query\Engine\MySQL\Builder;
use RsORM\Query\Engine\MySQL\Flag;

class ReplaceTest extends RsORMTest\Base {
    
    public function testShort() {
        $query = Builder::replace(["id" => 1, "name" => "Mike"])
                ->table("users");
        $stmt = $query->build();
        $this->assertSame("REPLACE INTO `users` (`id`, `name`) VALUES (?, ?)", $stmt->prepare());
        $this->assertSame([1, "Mike"], $stmt->values());
    }
    
    public function testFull() {
        $query = Builder::replace(["id" => 1, "name" => "Mike"])
                ->table("users")
                ->flags([new Flag\HighPriority()]);
        $stmt = $query->build();
        $this->assertSame("REPLACE HIGH_PRIORITY INTO `users` (`id`, `name`) VALUES (?, ?)", $stmt->prepare());
        $this->assertSame([1, "Mike"], $stmt->values());
    }
}
