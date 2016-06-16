<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL;

abstract class AbstractExpression implements MultiValueInterface {
    
    /**
     * @var ExpressionInterface[]
     */
    private $_arguments = [];
    
    /**
     * @param ExpressionInterface[] $arguments
     */
    public function __construct(array $arguments) {
        foreach ($arguments as $argument) {
            if ($argument !== null) {
                $this->_arguments[] = $argument;
            }
        }
    }
    
    /**
     * @return array
     */
    public function values() {
        $result = [];
        foreach ($this->_arguments as $argument) {
            if ($argument instanceof SingleValueInterface) {
                $result[] = $argument->value();
            }
            if ($argument instanceof MultiValueInterface) {
                $result = array_merge($result, $argument->values());
            }
        }
        return $result;
    }
    
    /**
     * @return string[]
     */
    protected function _prepareArguments() {
        $result = [];
        foreach ($this->_arguments as $argument) {
            if ($this instanceof Expression\AbstractOperator && $argument instanceof Expression\AbstractOperator) {
                $result[] = "({$argument->prepare()})";
            } else {
                $result[] = $argument->prepare();
            }
        }
        return $result;
    }
    
}
