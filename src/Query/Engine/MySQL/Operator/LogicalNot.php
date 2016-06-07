<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operator;

class LogicalNot extends AbstractSingleOperand {
    
    /**
     * @return string
     */
    protected function _operator() {
        return "NOT";
    }
    
}
