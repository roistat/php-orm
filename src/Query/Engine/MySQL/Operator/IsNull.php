<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operator;

class IsNull extends Is {
    
    /**
     * @param bool|int|float|string|AbstractOperator $operand
     */
    public function __construct($operand) {
        parent::__construct($operand, new NullValue());
    }
    
}
