<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL;

abstract class AbstractExpression implements MultiValueInterface {
    
    /**
     * @var ObjectInterface[][]
     */
    protected $_argumentsSets = [];
    
    /**
     * @param ObjectInterface[]|ObjectInterface[][] $arguments
     */
    public function __construct(array $arguments) {
        if (count($arguments) === 0) {
            return;
        }
        if (is_array($arguments[0])) {
            $this->_argumentsSets = $arguments;
        } else {
            $this->_argumentsSets = [$arguments];
        }
    }
    
    /**
     * @return array
     */
    public function values() {
        $result = [];
        foreach ($this->_argumentsSets as $arguments) {
            foreach ($arguments as $argument) {
                if ($argument instanceof SingleValueInterface) {
                    $result[] = $argument->value();
                }
                if ($argument instanceof MultiValueInterface) {
                    $result = array_merge($result, $argument->values());
                }
            }
        }
        return $result;
    }
    
    /**
     * @return string[]
     */
    protected function _prepareArguments() {
        $result = [];
        foreach ($this->_argumentsSets as $arguments) {
            foreach ($arguments as $argument) {
                if ($argument instanceof ObjectInterface) {
                    $result[] = $argument->prepare();
                }
            }
        }
        return $result;
    }
    
}
