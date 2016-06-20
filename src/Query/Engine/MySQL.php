<?php
/**
 * @author Evgeniy Udodov <flr.null@gmail.com>
 */

namespace RsORM\Query\Engine;

use RsORM\Query\Engine\MySQL\Clause;
use RsORM\Query\Engine\MySQL\Statement;

class MySQL {
    
    /**
     * @param Clause\Fields $fields
     * @param Clause\From $table
     * @param Clause\Filter $filter
     * @param Clause\Group $group
     * @param Clause\Having $having
     * @param Clause\Order $order
     * @param Clause\Limit $limit
     * @return Statement\Select
     */
    public function select(Clause\Fields $fields, Clause\From $table = null, Clause\Filter $filter = null, Clause\Group $group = null, Clause\Having $having = null, Clause\Order $order = null, Clause\Limit $limit = null) {
        return new Statement\Select($fields, $table, $filter, $group, $having, $order, $limit);
    }
    
    /**
     * @param Clause\From $table
     * @param Clause\Filter $filter
     * @param Clause\Order $order
     * @param Clause\Limit $limit
     * @return Statement\Delete
     */
    public function delete(Clause\From $table, Clause\Filter $filter = null, Clause\Order $order = null, Clause\Limit $limit = null) {
        return new Statement\Delete($table, $filter, $order, $limit);
    }
    
    /**
     * @param Clause\Into $table
     * @param Clause\Values $values
     * @param Clause\Fields $fields
     * @return Statement\Insert
     */
    public function insert(Clause\Into $table, Clause\Values $values, Clause\Fields $fields = null) {
        return new Statement\Insert($table, $values, $fields);
    }
    
    /**
     * @param Clause\Target $table
     * @param Clause\Set $set
     * @param Clause\Filter $filter
     * @param Clause\Order $order
     * @param Clause\Limit $limit
     * @return Statement\Update
     */
    public function update(Clause\Target $table, Clause\Set $set, Clause\Filter $filter = null, Clause\Order $order = null, Clause\Limit $limit = null) {
        return new Statement\Update($table, $set, $filter, $order, $limit);
    }
    
}
