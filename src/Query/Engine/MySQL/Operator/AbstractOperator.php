<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Operator;

use RsORM;
use RsORM\Query\Engine\MySQL;

abstract class AbstractOperator extends MySQL\AbstractExpression {
    
    use RsORM\TraitClassHelper;
    
    protected function _prepareOperands() {
        $result = [];
        foreach ($this->_argumentsSets as $arguments) {
            foreach ($arguments as $argument) {
                if ($argument instanceof self) {
                    $result[] = "({$argument->prepare()})";
                } else {
                    $result[] = $argument->prepare();
                }
            }
        }
        return $result;
    }
    
}
