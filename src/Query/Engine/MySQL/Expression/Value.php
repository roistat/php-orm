<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Expression;

class Value extends AbstractOperand {
    
    /**
     * @var bool|int|float|string
     */
    private $_value;
    
    /**
     * @param bool|int|float|string $value
     */
    public function __construct($value) {
        if (is_bool($value)) {
            $value = (int) $value;
        }
        $this->_value = $value;
    }
    
    /**
     * @return string
     */
    public function prepare() {
        return "?";
    }
    
    /**
     * @return bool|int|float|string
     */
    public function value() {
        return $this->_value;
    }
    
}
