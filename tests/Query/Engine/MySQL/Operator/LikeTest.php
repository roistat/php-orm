<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDBTest\Query\Engine\MySQL\Operator;

use RSDB\Query\Engine\MySQL\Operator;
use RSDBTest;

class LikeTest extends RSDBTest\Base {
    
    public function testSimpleValues() {
        $stmt = new Operator\Like("Ivanov", "%van%");
        $this->assertSame("? LIKE ?", $stmt->prepare());
        $this->assertSame(["Ivanov", "%van%"], $stmt->values());
    }
    
    public function testComplexValues() {
        $stmt = new Operator\Like(new Operator\Column("name2"), new Operator\Value("%van%"));
        $this->assertSame("`name2` LIKE ?", $stmt->prepare());
        $this->assertSame(["%van%"], $stmt->values());
    }
    
}
