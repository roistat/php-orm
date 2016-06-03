<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operand;

class Enum extends AbstractOperand {
    
    /**
     * @return string
     */
    public function prepare() {
        return "(" . str_repeat("?, ", count($this->_values) - 1) . "?)";
    }
    
}
