<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Argument;

use RsORM\Query\Engine\MySQL;
use RsORM\Query\Engine\MySQL\Exception;

class Field implements MySQL\MultiValueInterface {
    
    /**
     * @var MySQL\ExpressionInterface
     */
    private $_expression;
    
    /**
     * @var Alias
     */
    private $_alias;
    
    /**
     * @param MySQL\ExpressionInterface $expression
     * @param Alias $alias
     */
    public function __construct(MySQL\ExpressionInterface $expression, Alias $alias = null) {
        $this->_expression = $expression;
        $this->_alias = $alias;
    }
    
    /**
     * @return string
     */
    public function prepare() {
        if ($this->_alias === null) {
            return $this->_expression->prepare();
        } else {
            return $this->_expression->prepare() . " AS " . $this->_alias->prepare();
        }
    }
    
    /**
     * @return array
     */
    public function values() {
        if ($this->_expression instanceof MySQL\SingleValueInterface) {
            return [$this->_expression->value()];
        }
        if ($this->_expression instanceof MySQL\MultiValueInterface) {
            return $this->_expression->values();
        }
        return [];
    }
    
}
