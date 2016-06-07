<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operator;

class IsNot extends AbstractPairOperand {
    
    /**
     * @return string
     */
    protected function _operator() {
        return "IS NOT";
    }
    
}
