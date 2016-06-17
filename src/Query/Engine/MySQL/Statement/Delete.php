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
     */
    public function __construct(Clause\From $table, Clause\Filter $filter = null, Clause\Order $order = null, Clause\Limit $limit = null) {
        parent::__construct([$table, $filter, $order, $limit]);
    }
    
    /**
     * @return string
     */
    protected function _statementOperator() {
        return "DELETE";
    }
    
}
