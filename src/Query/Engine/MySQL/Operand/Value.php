<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operand;

class Value extends AbstractOperand {
    
    /**
     * @param mixed $operand
     */
    public function __construct($operand) {
        parent::__construct([$operand]);
    }
    
    /**
     * @return string
     */
    public function prepare() {
        return "?";
    }
    
}
