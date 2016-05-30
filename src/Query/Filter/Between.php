<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Filter;

class Between extends AbstractFilter {
    
    public function __construct($field, $min, $max) {
        parent::__construct($field);
        $this->_parameters = [$min, $max];
    }
    
    protected function _operator() {
        return "BETWEEN";
    }
    
}
