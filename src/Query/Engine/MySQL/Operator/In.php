<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operator;

use RSDB\Query\Engine\MySQL\Operand;

class In extends AbstractPairOperator {
    
    /**
     * @param Operand\AbstractOperand $operand
     * @param Operand\Enum $enum
     */
    public function __construct(Operand\AbstractOperand $operand, Operand\Enum $enum) {
        parent::__construct($operand, $enum);
    }
    
    /**
     * @return string
     */
    protected function _operator() {
        return "IN";
    }
    
}
