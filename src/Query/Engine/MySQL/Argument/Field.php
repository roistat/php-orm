<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Argument;

use RsORM\Query\Engine\MySQL;

class Field implements MySQL\MultiValueInterface {
    
    /**
     * @var MySQL\ExpressionInterface
     */
    private $_expression;
    
    /**
     * @var string
     */
    private $_alias;
    
    /**
     * @param MySQL\ExpressionInterface $expression
     * @param string $alias
     */
    public function __construct(MySQL\ExpressionInterface $expression, $alias = null) {
        $this->_expression = $expression;
        $this->_alias = $alias;
    }
    
    /**
     * @return string
     */
    public function prepare() {
        return $this->_expression->prepare() . $this->_prepareAlias();
    }
    
    /**
     * @return array
     */
    public function values() {
        if ($this->_expression instanceof MySQL\SingleValueInterface) {
            if ($this->_expression->value() === null) {
                return [];
            } else {
                return [$this->_expression->value()];
            }
        } else {
            return $this->_expression->values();
        }
    }
    
    /**
     * @return string
     */
    private function _prepareAlias() {
        if (empty($this->_alias)) {
            return "";
        } else {
            return " AS {$this->_alias}";
        }
    }
        
}
