<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Expression;

abstract class AbstractUnaryOperator extends AbstractSimpleOperator {
    
    /**
     * @param ObjectInterface $operand
     */
    public function __construct(ObjectInterface $operand) {
        parent::__construct([$operand]);
    }
    
    /**
     * @return string
     */
    public function prepare() {
        return "{$this->_prepareOperator()} {$this->_operands[0]->prepare()}";
    }
    
}
