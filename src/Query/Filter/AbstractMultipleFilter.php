<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Filter;

abstract class AbstractMultipleFilter extends AbstractFilter {
    
    /**
     * @return string
     */
    public function prepare() {
        return implode($this->_operator(), $this->_prepareOperands());
    }
    
}