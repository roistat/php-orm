<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Clause;

use RsORM\Query\Engine\MySQL;

abstract class AbstractClause implements MySQL\MultiValueInterface {
    
    /**
     * @var MySQL\ExpressionInterface
     */
    private $_arguments = [];
    
    /**
     * @param MySQL\ExpressionInterface $arguments
     */
    public function __construct(array $arguments) {
        $this->_arguments = $arguments;
    }
    
    /**
     * @return array
     */
    public function values() {
        $result = [];
        foreach ($this->_arguments as $argument) {
            if ($argument instanceof MySQL\SingleValueInterface && $argument->value() !== null) {
                $result[] = $argument->value();
            }
            if ($argument instanceof MySQL\MultiValueInterface) {
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
            $result[] = $argument->prepare();
        }
        return $result;
    }
    
}
