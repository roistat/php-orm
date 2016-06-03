<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operand;

class NullValue extends AbstractOperand {
    
    public function __construct() {
        parent::__construct([]);
    }
    
    /**
     * @return string
     */
    public function prepare() {
        return "NULL";
    }
    
    /**
     * @return array
     */
    public function values() {
        return [];
    }
    
}
