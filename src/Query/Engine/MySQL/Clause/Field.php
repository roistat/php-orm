<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Clause;

use RsORM\Query\Engine\MySQL;
use RsORM\Query\Engine\MySQL\Argument;

class Field extends AbstractClause {
    
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
        return $this->_prepareExpression() . $this->_prepareAlias();
    }
    
    /**
     * @return array
     */
    public function values() {
        if ($this->_expression instanceof Argument\AbstractArgument) {
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
    
    private function _prepareExpression() {
        if ($this->_expression instanceof Argument\AbstractArgument) {
            return $this->_expression->prepare();
        } else {
            return "({$this->_expression->prepare()})";
        }
    }
    
}
