<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operator;

use RSDB\Query\Engine\MySQL\Operand;

abstract class AbstractSingleOperator extends AbstractOperator {
    
    /**
     * @param Operand\AbstractOperand $operand
     */
    public function __construct(Operand\AbstractOperand $operand) {
        parent::__construct([$operand]);
    }
    
    /**
     * @return string
     */
    public function prepare() {
        return "{$this->_operator()} {$this->_prepareOperand($this->_values[0])}";
    }
    
}
