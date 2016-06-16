<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Expression;

use RsORM\Query\Engine\MySQL;

class In extends AbstractCustomOperator {
    
    /**
     * @param MySQL\ExpressionInterface $operand
     * @param MySQL\ExpressionInterface[] $operands
     */
    public function __construct(MySQL\ExpressionInterface $operand, array $operands) {
        array_unshift($operands, $operand);
        parent::__construct($operands);
    }
    
    /**
     * @return string
     */
    public function prepare() {
        $preparedArguments = $this->_prepareArguments();
        $operand = array_shift($preparedArguments);
        $operands = implode(", ", $preparedArguments);
        return "{$operand} IN ({$operands})";
    }
    
}
