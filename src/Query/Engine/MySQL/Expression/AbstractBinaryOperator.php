<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Expression;

use RsORM\Query\Engine\MySQL;

abstract class AbstractBinaryOperator extends AbstractSimpleOperator {
    
    /**
     * @param MySQL\ExpressionInterface $operand1
     * @param MySQL\ExpressionInterface $operand2
     */
    public function __construct(MySQL\ExpressionInterface $operand1, MySQL\ExpressionInterface $operand2) {
        parent::__construct([$operand1, $operand2]);
    }
    
    /**
     * @return string
     */
    public function prepare() {
        $preparedArguments = $this->_prepareArguments();
        return "{$preparedArguments[0]} {$this->_prepareOperator()} {$preparedArguments[1]}";
    }
    
}
