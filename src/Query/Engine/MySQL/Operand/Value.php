<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operand;

class Value extends AbstractOperand {
    
    /**
     * @param int|float|string $value
     */
    public function __construct($value) {
        parent::__construct([$value]);
    }
    
    /**
     * @return string
     */
    public function prepare() {
        return "?";
    }
    
}
