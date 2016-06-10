<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Expression;

abstract class AbstractBinaryOperator extends AbstractSimpleOperator {
    
    /**
     * @param ObjectInterface $operand1
     * @param ObjectInterface $operand2
     */
    public function __construct(ObjectInterface $operand1, ObjectInterface $operand2) {
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
