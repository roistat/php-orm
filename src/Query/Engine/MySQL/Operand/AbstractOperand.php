<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operand;

abstract class AbstractOperand {
    
    /**
     * @var array
     */
    protected $_values = [];
    
    /**
     * @param array $values
     */
    public function __construct(array $values) {
        $this->_values = $values;
    }
    
    /**
     * @return string
     */
    abstract public function prepare();
    
    /**
     * @return array
     */
    public function values() {
        return $this->_values;
    }
    
}
