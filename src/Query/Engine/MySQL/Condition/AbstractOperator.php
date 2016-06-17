<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Condition;

use RsORM\Query\Engine\MySQL;

abstract class AbstractOperator extends MySQL\AbstractExpression {
    
    protected function _prepareOperands() {
        $result = [];
        foreach ($this->_arguments as $argument) {
            if ($argument instanceof self) {
                $result[] = "({$argument->prepare()})";
            } else {
                $result[] = $argument->prepare();
            }
        }
        return $result;
    }
    
}
