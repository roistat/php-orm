<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Condition;

class LogicalOr extends AbstractMultipleOperator {
    
    /**
     * @return string
     */
    protected function _operator() {
        return "OR";
    }
    
}