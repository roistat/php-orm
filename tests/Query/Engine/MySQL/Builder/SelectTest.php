<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Builder;

use RsORMTest;
use RsORM\Query\Engine\MySQL\Builder;
use RsORM\Query\Engine\MySQL\Flag;
use RsORM\Query\Engine\MySQL\Argument\Value;

class SelectTest extends RsORMTest\Base {
    
    public function testShort() {
        $stmt = Builder::select([new Value(123)])->build();
        $this->assertSame("SELECT ?", $stmt->prepare());
        $this->assertSame([123], $stmt->values());
    }
    
    public function testFull() {
        $filter = Builder::filter()->eq("type", 123);
        $having = Builder::filter()->eq('pos', 3);
        $stmt = Builder::select(['id', 'user', Builder::funcCount('id', 'num', true)])
            ->table('users')
            ->where($filter)
            ->limit(10, 20)
            ->order("id")->order("name", false)
            ->group("id")->group("name", false)
            ->having($having)
            ->flagHighPriority()
            ->build();
        $this->assertSame('SELECT HIGH_PRIORITY id, user, COUNT(DISTINCT id) AS num FROM users WHERE type = ? GROUP BY id, name DESC HAVING pos = ? ORDER BY id, name DESC LIMIT ? OFFSET ?', $stmt->prepare());
        $this->assertSame([123, 3, 10, 20], $stmt->values());
    }
    
    public function testSingleLimit() {
        $stmt = Builder::select([new Value(123)])
                ->limit(1)
                ->build();
        $this->assertSame("SELECT ? LIMIT ?", $stmt->prepare());
        $this->assertSame([123, 1], $stmt->values());
    }
}
