<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Filter;

abstract class AbstractComparativeFilter extends AbstractFilter {
    
    /**
     * @param string $field
     * @param mixed $parameter
     */
    public function __construct($field, $parameter) {
        parent::__construct($field);
        $this->_parameters = [$parameter];
    }
    
}
