<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operator;

abstract class AbstractPairOperand extends AbstractComplexOperand {
    
    /**
     * @return string
     */
    abstract protected function _operator();
    
    /**
     * @param bool|int|float|string|AbstractOperand $operand1
     * @param bool|int|float|string|AbstractOperand $operand2
     */
    public function __construct($operand1, $operand2) {
        parent::__construct([$operand1, $operand2]);
    }
    
    /**
     * @return string
     */
    public function prepare() {
        $values = $this->_prepareValues();
        return "{$values[0]} {$this->_operator()} {$values[1]}";
    }
    
}
