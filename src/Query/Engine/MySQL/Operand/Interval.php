<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operand;

class Interval extends AbstractOperand {
    public function __construct($min, $max) {
        parent::__construct([$min, $max]);
    }
    public function prepare() {
        return "? AND ?";
    }
}
