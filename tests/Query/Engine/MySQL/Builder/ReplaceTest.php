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
        $query = Builder::insert(['name' => 'vasya', 'pass' => md5('1')])
            ->table('users')
            ->flags([new Flag\HighPriority()]);
        $stmt = $query->build();

        $this->assertSame('INSERT HIGH_PRIORITY INTO `users` (`name`, `pass`) VALUES (?, ?)', $stmt->prepare());
        $this->assertSame(['vasya', 'c4ca4238a0b923820dcc509a6f75849b'], $stmt->values());
    }
}
