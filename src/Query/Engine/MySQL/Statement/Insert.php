<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Statement;

use RsORM\Query\Engine\MySQL\Clause;

class Insert extends AbstractStatement {
    
    /**
     * @param Clause\Into $table
     * @param Clause\Fields $fields
     * @param Clause\Values $values
     */
    public function __construct(Clause\Into $table, Clause\Values $values, Clause\Fields $fields = null) {
        parent::__construct([$table, $fields, $values]);
    }
    
    /**
     * @return string
     */
    protected function _statementOperator() {
        return "INSERT";
    }
    
}
