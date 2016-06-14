<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Statement;

use RsORM\Query\Engine\MySQL\Clause;

class Select extends AbstractStatement {
    
    /**
     * @param Clause\Fields $fields
     * @param Clause\Table $table
     * @param Clause\Filter $filter
     */
    public function __construct(Clause\Fields $fields, Clause\Table $table = null, Clause\Filter $filter = null) {
        parent::__construct([$fields, $table, $filter]);
    }
    
    /**
     * @return string
     */
    protected function _statementOperator() {
        return "SELECT";
    }
    
}
