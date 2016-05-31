<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operand;

/**
 * Description of Enum
 *
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */
class Enum extends AbstractOperand {
    public function prepare() {
        return "(" . str_repeat("?, ", count($this->_values) - 1) . "?)";
    }
}
