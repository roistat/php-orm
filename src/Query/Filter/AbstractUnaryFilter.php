<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Filter;

abstract class AbstractUnaryFilter extends AbstractFilter {
    
    /**
     * @return string
     */
    public function prepare() {
        $result = $this->_prepareOperand(0);
        if ($this->_isPrefix()) {
            $result = $this->_operator() . $result;
        }
        else {
            $result .= $this->_operator();
        }
        return $result;
    }
    
    /**
     * @return boolean
     */
    protected function _isPrefix() {
        return true;
    }
    
}
