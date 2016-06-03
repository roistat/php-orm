<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operator;

use RSDB\Query\Engine\MySQL\Operand;

class IsNotNull extends IsNot {
    
    /**
     * @param Operand\AbstractOperand $operand1
     */
    public function __construct(Operand\AbstractOperand $operand1) {
        parent::__construct($operand1, new Operand\NullValue());
    }
    
}
