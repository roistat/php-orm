<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Expression;

class Column extends AbstractOperand {
    
    /**
     * @var string
     */
    private $_name;
    
    /**
     * @param string $name
     */
    public function __construct($name) {
        $this->_name = $name;
    }
    
    /**
     * @return string
     */
    public function prepare() {
        return "`{$this->_name}`";
    }
    
    public function value() {
        return NULL;
    }
    
}
