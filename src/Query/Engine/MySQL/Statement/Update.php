<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Statement;

use RsORM\Query\Engine\MySQL\Clause;
use RsORM\Query\Engine\MySQL\Argument;

class Update extends AbstractStatement {
    
    /**
     * @param Argument\Table $table
     * @param Clause\Set $set
     * @param Clause\Filter $filter
     * @param Clause\Order $order
     * @param Clause\Limit $limit
     */
    public function __construct(Argument\Table $table, Clause\Set $set, Clause\Filter $filter = null, Clause\Order $order = null, Clause\Limit $limit = null) {
        parent::__construct([$table, $set, $filter, $order, $limit]);
    }
    
    /**
     * @return string
     */
    protected function _statementOperator() {
        return "UPDATE";
    }
    
}
