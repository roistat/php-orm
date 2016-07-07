<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query;

use RsORMTest;
use RsORM\Query\Builder;

class BuilderTest extends RsORMTest\Base {
    
    public function test() {
        $filter = Builder::filter()
                ->eq("id", 1)
                ->eq("id", 2, false)
                ->_or()
                ->eq("name", "Mike");
        $query = Builder::select(["id", "user", "pass"])
                ->from("users")
                ->where($filter);
        $stmt = $query->build();
        $this->assertSame("SELECT `id`, `user`, `pass` FROM `users` WHERE ((`id` = ?) AND (`id` != ?)) OR (`name` = ?)", $stmt->prepare());
        $this->assertSame([1, 2, "Mike"], $stmt->values());
    }
    
    public function test2() {
        $query = Builder::select(["id", "user", "pass"])
                ->from("users")
                ->whereEq("id", 1)
                ->whereEq("id", 2, false)
                ->whereOr()
                ->whereEq("name", "Mike");
        $stmt = $query->build();
        $this->assertSame("SELECT `id`, `user`, `pass` FROM `users` WHERE ((`id` = ?) AND (`id` != ?)) OR (`name` = ?)", $stmt->prepare());
        $this->assertSame([1, 2, "Mike"], $stmt->values());
    }
    
}
