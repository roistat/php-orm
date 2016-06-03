<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operator;

use RSDB\Query\Engine\MySQL\Operand;

class Between extends AbstractPairOperator {
    
    /**
     * @param Operand\AbstractOperand $operand
     * @param Operand\Interval $interval
     */
    public function __construct(Operand\AbstractOperand $operand, Operand\Interval $interval) {
        parent::__construct($operand, $interval);
    }
    
    /**
     * @return string
     */
    protected function _operator() {
        return "BETWEEN";
    }
        
}
