<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Condition;

class LogicalNot extends AbstractUnaryOperator {
    
    /**
     * @return string
     */
    protected function _operator() {
        return "NOT";
    }
    
}
