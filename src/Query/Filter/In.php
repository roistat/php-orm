<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Filter;

class In extends AbstractFilter {
    
    /**
     * @param string $field
     * @param mixed[] $parameters
     * @throws \Exception
     */
    public function __construct($field, array $parameters) {
        if (count($parameters) === 0) {
            throw new \Exception("Empty parameters");
        }
        parent::__construct($field);
        $this->_parameters = $parameters;
    }
    
    protected function _operator() {
        return "IN";
    }
    
}
