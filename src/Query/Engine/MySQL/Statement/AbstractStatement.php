<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Statement;

use RsORM\Query\Engine\MySQL;
use RsORM\Query\Engine\MySQL\Clause;

abstract class AbstractStatement implements MySQL\ExpressionInterface {
    
    /**
     * @var Clause\AbstractClause[]
     */
    private $_clauses = [];
    
    /**
     * @return string
     */
    abstract protected function _statementOperator();
    
    /**
     * @param Clause\AbstractClause[] $clauses
     */
    public function __construct(array $clauses) {
        $this->_clauses = $clauses;
    }
    
    /**
     * @return string
     */
    public function prepare() {
        return $this->_statementOperator() . " " . implode(" ", $this->_prepareClauses());
    }
    
    /**
     * @return array
     */
    public function values() {
        $result = [];
        foreach ($this->_clauses as $clause) {
            $result = array_merge($result, $clause->values());
        }
        return $result;
    }
    
    /**
     * @return string[]
     */
    private function _prepareClauses() {
        $result = [];
        foreach ($this->_clauses as $clause) {
            $result[] = $clause->prepare();
        }
        return $result;
    }
    
}
