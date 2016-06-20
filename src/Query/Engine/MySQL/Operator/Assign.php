<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Operator;

class Assign extends AbstractBinaryOperator {
    
    /**
     * @return string
     */
    protected function _operator() {
        return "=";
    }
    
}
