<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operator;

class Between extends AbstractPairOperator {
    
    /**
     * @param bool|int|float|string|AbstractOperator $operand
     * @param Interval $interval
     */
    public function __construct($operand, Interval $interval) {
        parent::__construct($operand, $interval);
    }
    
    /**
     * @return string
     */
    protected function _operator() {
        return "BETWEEN";
    }
        
}
