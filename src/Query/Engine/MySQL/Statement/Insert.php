<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Statement;

use RsORM\Query\Engine\MySQL\Clause;

class Insert extends AbstractStatement {
    
    /**
     * @param Clause\Into $table
     * @param Clause\Values $values
     * @param Clause\InsertFields $fields
     * @param Clause\Flags $flags
     */
    public function __construct(Clause\Into $table, Clause\Values $values, Clause\InsertFields $fields = null, Clause\Flags $flags = null) {
        parent::__construct([$flags, $table, $fields, $values]);
    }
    
    /**
     * @return string
     */
    protected function _statementOperator() {
        return "INSERT";
    }
    
}
