<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operator;

use RSDB\Query\Engine\MySQL\Operand;

abstract class AbstractPairOperator extends AbstractOperator {
    
    /**
     * @param Operand\AbstractOperand $operand1
     * @param Operand\AbstractOperand $operand2
     */
    public function __construct(Operand\AbstractOperand $operand1, Operand\AbstractOperand $operand2) {
        parent::__construct([$operand1, $operand2]);
    }
    
    /**
     * @return string
     */
    public function prepare() {
        return "{$this->_prepareOperand($this->_values[0])} {$this->_operator()} {$this->_prepareOperand($this->_values[1])}";
    }
    
}
