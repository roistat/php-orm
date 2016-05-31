<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operand;

abstract class AbstractOperand {
    protected $_values = [];
    public function __construct(array $values) {
        $this->_values = $values;
    }
    abstract public function prepare();
    public function values() {
        return $this->_values;
    }
}
