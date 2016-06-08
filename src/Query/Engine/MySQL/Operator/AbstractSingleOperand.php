<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operator;

abstract class AbstractSingleOperand extends AbstractComplexOperand {
    
    /**
     * @return string
     */
    abstract protected function _operator();
    
    /**
     * @param bool|int|float|string|AbstractOperand $operand
     */
    public function __construct($operand) {
        parent::__construct([$operand]);
    }
    
    /**
     * @return string
     */
    public function prepare() {
        $values = $this->_prepareValues();
        return "{$this->_operator()} {$values[0]}";
    }
    
}
