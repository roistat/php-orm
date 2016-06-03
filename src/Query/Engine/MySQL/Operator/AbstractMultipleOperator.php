<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operator;

abstract class AbstractMultipleOperator extends AbstractOperator {
    
    /**
     * @return string
     */
    public function prepare() {
        $result = "";
        foreach ($this->_values as $value) {
            if ($result) {
                $result .= " {$this->_operator()} ";
            }
            $result .= $this->_prepareOperand($value);
        }
        return $result;
    }
    
}
