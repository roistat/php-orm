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
        $preparedArguments = $this->_prepareArguments();
        return "{$preparedArguments[0]} BETWEEN {$preparedArguments[1]} AND {$preparedArguments[2]}";
    }
    
}
