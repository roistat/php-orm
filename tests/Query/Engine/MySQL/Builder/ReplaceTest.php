<?php
/**
 * @author Yury Zyuzkevich <farengier@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Builder;

use RsORMTest;
use RsORM\Query\Engine\MySQL\Builder;
use RsORM\Query\Engine\MySQL\Flag;

class ReplaceTest extends RsORMTest\Base {
    public function test() {
        $query = Builder::replace(['name' => 'vasya', 'pass' => md5('1')])
            ->table('users')
            ->flags([new Flag\HighPriority()]);
        $stmt = $query->build();

        $this->assertSame('REPLACE HIGH_PRIORITY INTO `users` (`name`, `pass`) VALUES (?, ?)', $stmt->prepare());
        $this->assertSame(['vasya', 'c4ca4238a0b923820dcc509a6f75849b'], $stmt->values());
    }
}
