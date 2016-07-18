<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Builder;

use RsORMTest;
use RsORM\Query\Engine\MySQL\Builder;
use RsORM\Query\Engine\MySQL\Flag;

class DeleteTest extends RsORMTest\Base {
    
    public function test() {
        $filter = Builder::filter()->compare("id", 123);
        $query = Builder::delete()
            ->table('users')
            ->where($filter)
            ->limit(10, 20)
            // todo order builder like filter builder
            ->order(['pass', 'id', Builder::desc('name')])
            ->flags([new Flag\HighPriority()]);
        $stmt = $query->build();

        $this->assertSame('DELETE HIGH_PRIORITY FROM `users` WHERE `id` = ? ORDER BY `pass`, `id`, `name` DESC LIMIT ?, ?', $stmt->prepare());
        $this->assertSame([123, 10, 20], $stmt->values());
    }
    
}
