<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operand;

class Interval extends AbstractOperand {
    
    /**
     * @param int|float|string $min
     * @param int|float|string $max
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
