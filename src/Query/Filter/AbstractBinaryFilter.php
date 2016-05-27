<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Filter;

abstract class AbstractBinaryFilter extends AbstractFilter {
    
    /**
     * @return string
     */
    public function prepare() {
        return $this->_prepareOperand(0) . $this->_operator() . $this->_prepareOperand(1);
    }
    
}
