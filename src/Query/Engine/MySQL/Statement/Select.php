<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Statement;

use RsORM\Query\Engine\MySQL\Clause;

class Select extends AbstractStatement {
    
    /**
     * @param Clause\Fields $fields
     * @param Clause\From $table
     * @param Clause\Filter $filter
     * @param Clause\Group $group
     * @param Clause\Having $having
     * @param Clause\Order $order
     * @param Clause\Limit $limit
     * @param Clause\Flags $flags
     */
    public function __construct(Clause\Fields $fields, Clause\From $table = null, Clause\Filter $filter = null, Clause\Group $group = null, Clause\Having $having = null, Clause\Order $order = null, Clause\Limit $limit = null, Clause\Flags $flags = null) {
        parent::__construct([$flags, $fields, $table, $filter, $group, $having, $order, $limit]);
    }
    
    /**
     * @return string
     */
    protected function _statementOperator() {
        return "SELECT";
    }
    
}
