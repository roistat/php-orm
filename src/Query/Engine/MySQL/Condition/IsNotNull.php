<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Condition;

use RsORM\Query\Engine\MySQL;

class IsNotNull extends IsNot {
    
    /**
     * @param MySQL\ObjectInterface $operand
     */
    public function __construct(MySQL\ObjectInterface $operand) {
        parent::__construct($operand, new MySQL\Argument\NullValue());
    }
    
}
