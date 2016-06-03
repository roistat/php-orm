<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operand;

class Interval extends AbstractOperand {
    
    /**
     * @param mixed $min
     * @param mixed $max
     */
    public function __construct($min, $max) {
        parent::__construct([$min, $max]);
    }
    
    /**
     * @return string
     */
    public function prepare() {
        return "? AND ?";
    }
    
}
