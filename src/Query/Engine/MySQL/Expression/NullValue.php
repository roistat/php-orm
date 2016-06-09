<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Expression;

class NullValue extends AbstractOperand {
    
    /**
     * @return string
     */
    public function prepare() {
        return "NULL";
    }
    
    public function value() {
        return null;
    }
    
}
