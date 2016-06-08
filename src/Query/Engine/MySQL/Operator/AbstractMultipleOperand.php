<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operator;

abstract class AbstractMultipleOperand extends AbstractComplexOperand {
    
    /**
     * @return string
     */
    abstract protected function _operator();
    
    /**
     * @return string
     */
    public function prepare() {
        return implode(" {$this->_operator()} ", $this->_prepareValues());
    }

}
