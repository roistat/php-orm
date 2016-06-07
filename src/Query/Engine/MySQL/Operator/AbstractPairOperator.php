<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operator;

abstract class AbstractPairOperator extends AbstractComplexOperator {
    
    /**
     * @return string
     */
    abstract protected function _operator();
    
    /**
     * @param bool|int|float|string|AbstractOperator $operand1
     * @param bool|int|float|string|AbstractOperator $operand2
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
