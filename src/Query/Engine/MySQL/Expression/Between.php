<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Expression;

use RsORM\Query\Engine\MySQL;

class Between extends AbstractCustomOperator {
    
    /**
     * @param MySQL\ExpressionInterface $operand
     * @param MySQL\ExpressionInterface $min
     * @param MySQL\ExpressionInterface $max
     */
    public function __construct(MySQL\ExpressionInterface $operand, MySQL\ExpressionInterface $min, MySQL\ExpressionInterface $max) {
        parent::__construct([$operand, $min, $max]);
    }
    
    /**
     * @return string
     */
    public function prepare() {
        $preparedOperands = $this->_prepareOperands();
        return "{$preparedOperands[0]} BETWEEN {$preparedOperands[1]} AND {$preparedOperands[2]}";
    }
    
}
