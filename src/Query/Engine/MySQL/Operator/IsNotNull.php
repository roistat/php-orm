<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operator;

class IsNotNull extends IsNot {
    
    /**
     * @param int|float|bool|string|AbstractOperator $operand
     */
    public function __construct($operand) {
        parent::__construct($operand, new NullValue());
    }
    
}
