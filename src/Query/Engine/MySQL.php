<?php
/**
 * @author Evgeniy Udodov <flr.null@gmail.com>
 */

namespace RsORM\Query\Engine;

use RsORM\Query\Engine\MySQL\Clause;
use RsORM\Query\Engine\MySQL\Statement;

class MySQL {
    
    /**
     * @param Clause\Objects $objects
     * @param Clause\From $table
     * @param Clause\Filter $filter
     * @param Clause\Group $group
     * @param Clause\Having $having
     * @param Clause\Order $order
     * @param Clause\Limit $limit
     * @param Clause\Flags $flags
     * @return Statement\Select
     */
    public function select(Clause\Objects $objects, Clause\From $table = null, Clause\Filter $filter = null, Clause\Group $group = null, Clause\Having $having = null, Clause\Order $order = null, Clause\Limit $limit = null, Clause\Flags $flags = null) {
        return new Statement\Select($objects, $table, $filter, $group, $having, $order, $limit, $flags);
    }
    
    /**
     * @param Clause\From $table
     * @param Clause\Filter $filter
     * @param Clause\Order $order
     * @param Clause\Limit $limit
     * @param Clause\Flags $flags
     * @return Statement\Delete
     */
    public function delete(Clause\From $table, Clause\Filter $filter = null, Clause\Order $order = null, Clause\Limit $limit = null, Clause\Flags $flags = null) {
        return new Statement\Delete($table, $filter, $order, $limit, $flags);
    }
    
    /**
     * @param Clause\Into $table
     * @param Clause\Values $values
     * @param Clause\Fields $fields
     * @param Clause\Flags $flags
     * @return Statement\Insert
     */
    public function insert(Clause\Into $table, Clause\Values $values, Clause\Fields $fields = null, Clause\Flags $flags = null) {
        return new Statement\Insert($table, $values, $fields, $flags);
    }
    
    /**
     * @param Clause\Into $table
     * @param Clause\Values $values
     * @param Clause\Fields $fields
     * @param Clause\Flags $flags
     * @return Statement\Replace
     */
    public function replace(Clause\Into $table, Clause\Values $values, Clause\Fields $fields = null, Clause\Flags $flags = null) {
        return new Statement\Replace($table, $values, $fields, $flags);
    }
    
    /**
     * @param Clause\Target $table
     * @param Clause\Set $set
     * @param Clause\Filter $filter
     * @param Clause\Order $order
     * @param Clause\Limit $limit
     * @param Clause\Flags $flags
     * @return Statement\Update
     */
    public function update(Clause\Target $table, Clause\Set $set, Clause\Filter $filter = null, Clause\Order $order = null, Clause\Limit $limit = null, Clause\Flags $flags = null) {
        return new Statement\Update($table, $set, $filter, $order, $limit, $flags);
    }
    
}
