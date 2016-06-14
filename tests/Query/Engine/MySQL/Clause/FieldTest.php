<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Clause;

use RsORMTest;
use RsORM\Query\Engine\MySQL\Clause;
use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Engine\MySQL\Expression;

class FieldTest extends RsORMTest\Base {

    public function testColumn() {
        $field = new Clause\Field(new Argument\Column("id"));
        $this->assertSame("`id`", $field->prepare());
        $this->assertSame([], $field->values());
    }
    
    public function testColumnAlias() {
        $field = new Clause\Field(new Argument\Column("id"), "uid");
        $this->assertSame("`id` AS uid", $field->prepare());
        $this->assertSame([], $field->values());
    }
    
    public function testExpression() {
        $field = new Clause\Field(new Expression\Sum(new Argument\Value(10), new Argument\Value(20)));
        $this->assertSame("(? + ?)", $field->prepare());
        $this->assertSame([10, 20], $field->values());
    }
    
    public function testExpressionAlias() {
        $field = new Clause\Field(new Expression\Sum(new Argument\Value(10), new Argument\Value(20)), "field");
        $this->assertSame("(? + ?) AS field", $field->prepare());
        $this->assertSame([10, 20], $field->values());
    }
    
}
