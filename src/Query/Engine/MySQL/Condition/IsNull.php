<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Condition;

use RsORM\Query\Engine\MySQL;
use RsORM\Query\Engine\MySQL\Argument;

class IsNull extends Is {
    
    /**
     * @param MySQL\ObjectInterface $operand
     */
    public function __construct(MySQL\ObjectInterface $operand) {
        parent::__construct($operand, new Argument\NullValue());
    }
    
}
