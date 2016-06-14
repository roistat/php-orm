<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Argument;

class Value extends AbstractArgument {
    
    /**
     * @var int|float|string
     */
    private $_value;
    
    /**
     * @param boolean|int|float|string $value
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
     * @return int|float|string
     */
    public function value() {
        return $this->_value;
    }
    
}
