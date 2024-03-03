<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Statement;

use RsORM\Query\Engine\MySQL\Clause;

class Delete extends AbstractStatement {
    
    /**
     * @param Clause\From $table
     * @param Clause\Filter $filter
     * @param Clause\Order $order
     * @param Clause\Limit $limit
     * @param Clause\Flags $flags
     */
    public function __construct(Clause\From $table, Clause\Filter $filter = null, Clause\Order $order = null, Clause\Limit $limit = null, Clause\Returning $returning = null, Clause\Flags $flags = null) {
        parent::__construct([$flags, $table, $filter, $order, $limit, $returning]);
    }
    
    /**
     * @return string
     */
    protected function _statementOperator() {
        return "DELETE";
    }
    
}
