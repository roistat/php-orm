<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operand;

class Column extends AbstractOperand {
    
    /**
     * @param string $name
     */
    public function __construct($name) {
        parent::__construct([$name]);
    }
    
    /**
     * @return string
     */
    public function prepare() {
        return "`{$this->_values[0]}`";
    }
    
    /**
     * @return array
     */
    public function values() {
        return [];
    }
    
}
