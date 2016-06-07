<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operator;

class Value extends AbstractOperand {
    
    /**
     * @var int|float|string
     */
    private $_value;
    
    /**
     * @param int|float|bool|string $value
     */
    public function __construct($value) {
        if (is_bool($value)) {
            $this->_value = (int) $value;
        } else {
            $this->_value = $value;
        }
    }
    
    /**
     * @return string
     */
    public function prepare() {
        return "?";
    }
    
    /**
     * @return array
     */
    public function values() {
        return [$this->_value];
    }
        
}
