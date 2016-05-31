<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operand;

class Column extends AbstractOperand {
    public function __construct($name) {
        parent::__construct([$name]);
    }
    public function prepare() {
        return "`{$this->_values[0]}`";
    }
    public function values() {
        return [];
    }
}
