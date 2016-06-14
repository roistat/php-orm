<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Statement;

use RsORM\Query\Engine\MySQL\Clause;

abstract class AbstractStatement {
    
    /**
     * @var Clause\AbstractClause[]
     */
    protected $_clauses = [];
    
    /**
     * @return string
     */
    abstract protected function _name();
    
    /**
     * @param Clause\AbstractClause $clauses
     */
    public function __construct(array $clauses) {
        $this->_clauses = $clauses;
    }
    
    /**
     * @return string
     */
    public function prepare() {
        return $this->_name() . " " . implode(" ", $this->_prepareClauses());
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
    protected function _prepareClauses() {
        $result = [];
        foreach ($this->_clauses as $clause) {
            $result[] = $clause->prepare();
        }
        return $result;
    }
    
}
