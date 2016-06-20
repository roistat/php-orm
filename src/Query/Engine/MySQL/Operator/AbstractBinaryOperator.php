<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Operator;

use RsORM\Query\Engine\MySQL;

abstract class AbstractBinaryOperator extends AbstractSimpleOperator {
    
    /**
     * @param MySQL\ObjectInterface $operand1
     * @param MySQL\ObjectInterface $operand2
     */
    public function __construct(MySQL\ObjectInterface $operand1, MySQL\ObjectInterface $operand2) {
        parent::__construct([$operand1, $operand2]);
    }
    
    /**
     * @return string
     */
    public function prepare() {
        $preparedOperands = $this->_prepareOperands();
        return "{$preparedOperands[0]} {$this->_prepareOperator()} {$preparedOperands[1]}";
    }
    
}
