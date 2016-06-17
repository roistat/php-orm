<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Argument;

use RsORMTest;
use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Engine\MySQL\Condition;

class FieldTest extends RsORMTest\Base {

    public function testColumn() {
        $field = new Argument\Field(new Argument\Column("id"));
        $this->assertSame("`id`", $field->prepare());
        $this->assertSame([], $field->values());
    }
    
    public function testColumnAlias() {
        $field = new Argument\Field(new Argument\Column("id"), new Argument\Alias("uid"));
        $this->assertSame("`id` AS `uid`", $field->prepare());
        $this->assertSame([], $field->values());
    }
    
//    public function testExpression() {
//        $field = new Argument\Field(new Condition\Sum(new Argument\Value(10), new Argument\Value(20)));
//        $this->assertSame("(? + ?)", $field->prepare());
//        $this->assertSame([10, 20], $field->values());
//    }
//    
//    public function testExpressionAlias() {
//        $field = new Argument\Field(new Condition\Sum(new Argument\Value(10), new Argument\Value(20)), "field");
//        $this->assertSame("(? + ?) AS field", $field->prepare());
//        $this->assertSame([10, 20], $field->values());
//    }
    
}
