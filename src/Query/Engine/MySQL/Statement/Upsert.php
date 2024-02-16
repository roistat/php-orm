<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Statement;

use RsORM\Query\Engine\MySQL\Clause;

class Upsert extends AbstractStatement {

    public function __construct(Clause\Into $table, Clause\Values $values, Clause\Columns $columns = null, Clause\Returning $returning = null, Clause\Flags $flags = null) {
        parent::__construct([$flags, $table, $columns, $values, $returning]);
    }
    
    /**
     * @return string
     */
    protected function _statementOperator() {
        return "UPSERT";
    }    
}
