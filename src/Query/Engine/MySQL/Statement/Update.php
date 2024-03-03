<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Statement;

use RsORM\Query\Engine\MySQL\Clause;

class Update extends AbstractStatement {
    
    /**
     * @param Clause\Target $table
     * @param Clause\Set $set
     * @param Clause\Filter $filter
     * @param Clause\Order $order
     * @param Clause\Limit $limit
     * @param Clause\Flags $flags
     */
    public function __construct(Clause\Target $table, Clause\Set $set, Clause\Filter $filter = null, Clause\Order $order = null, Clause\Limit $limit = null, Clause\Returning $returning = null, Clause\Flags $flags = null) {
        parent::__construct([$flags, $table, $set, $filter, $order, $limit, $returning]);
    }
    
    /**
     * @return string
     */
    protected function _statementOperator() {
        return "UPDATE";
    }
    
}
