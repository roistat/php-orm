<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Expression;

use RsORM\Query\Engine\MySQL;

abstract class AbstractUnaryOperator extends AbstractSimpleOperator {
    
    /**
     * @param MySQL\ObjectInterface $operand
     */
    public function __construct(MySQL\ObjectInterface $operand) {
        parent::__construct([$operand]);
    }
    
    /**
     * @return string
     */
    public function prepare() {
        return "{$this->_prepareOperator()} {$this->_prepareOperands()[0]}";
    }
    
}
