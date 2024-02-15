<?php
/**
 * @author Yury Zyuzkevich <farengier@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Builder;

use RsORMTest;
use RsORM\Query\Engine\MySQL\Builder;

class UpdateTest extends RsORMTest\Base {
    
    public function testShort() {
        $stmt = Builder::update(["user" => "mike", "pass" => "123456"])
                ->table("users")
                ->build();
        $this->assertSame("UPDATE users SET user = ?, pass = ?", $stmt->prepare());
        $this->assertSame(["mike", "123456"], $stmt->values());
    }
    
    public function testFull() {
        $filter = Builder::filter()->eq("flag3", 1);
        $stmt = Builder::update(["user" => "mike", "pass" => "123456"])
                ->table("users")
                ->limit(10, 20)
                ->order("flag1")->order("flag2")
                ->where($filter)
                ->flagHighPriority()
                ->build();
        $this->assertSame("UPDATE HIGH_PRIORITY users SET user = ?, pass = ? WHERE flag3 = ? ORDER BY flag1, flag2 LIMIT ?, ?", $stmt->prepare());
        $this->assertSame(["mike", "123456", 1, 10, 20], $stmt->values());
    }
    
}
