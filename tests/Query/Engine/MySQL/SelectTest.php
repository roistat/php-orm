<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Expression;

use RsORM\Query\Engine\MySQL\Expression;
use RsORMTest;

class SelectTest extends RsORMTest\Base {

    public function test() {
        $fields = new Fields(new Field("id"), new Field("name"));
        $table = new Table("table");
        $filter = new Expression\Gt(new Expression\Column("id"), new Expression\Value(10));
        $stmt = new Select($fields, $table, $filter);
        $this->assertSame("SELECT `id`, `name` FROM `table` WHERE `id` > ?", $stmt->prepare());
        $this->assertSame([10], $stmt->values());
    }
    
}
