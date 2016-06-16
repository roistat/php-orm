<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Statement;

use RsORM\Query\Engine\MySQL;
use RsORM\Query\Engine\MySQL\Clause;

abstract class AbstractStatement extends MySQL\AbstractExpression {
    
    /**
     * @return string
     */
    abstract protected function _statementOperator();
    
    /**
     * @param Clause\AbstractClause[] $clauses
     */
    public function __construct(array $clauses) {
        parent::__construct($clauses);
    }
    
    /**
     * @return string
     */
    public function prepare() {
        return $this->_statementOperator() . " " . implode(" ", $this->_prepareArguments());
    }
    
}
