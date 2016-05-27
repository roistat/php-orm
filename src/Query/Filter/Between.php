<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Filter;

class Between extends AbstractFilter {
    
    protected function _operator() {
        return " BETWEEN ";
    }
    
    public function prepare() {
        return $this->_prepareOperand(0) . $this->_operator() . $this->_prepareOperand(1) . " AND " . $this->_prepareOperand(2);
    }
    
}
