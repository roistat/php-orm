<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Expression;

use RsORM\Query\Engine\MySQL;

class IsNotNull extends IsNot {
    
    /**
     * @param MySQL\ExpressionInterface $operand
     */
    public function __construct(MySQL\ExpressionInterface $operand) {
        parent::__construct($operand, new MySQL\Argument\NullValue());
    }
    
}
