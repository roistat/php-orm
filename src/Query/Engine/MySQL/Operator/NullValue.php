<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operator;

class NullValue extends AbstractOperand {
    
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
