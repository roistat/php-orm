<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operator;

class In extends AbstractPairOperator {
    
    /**
     * @param bool|int|float|string|AbstractOperator $operand
     * @param Enum $enum
     */
    public function __construct($operand, Enum $enum) {
        parent::__construct($operand, $enum);
    }
    
    /**
     * @return string
     */
    protected function _operator() {
        return "IN";
    }
    
}
