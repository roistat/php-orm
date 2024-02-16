<?php
/**
 * @author Evgeniy Udodov <flr.null@gmail.com>
 */

namespace RsORM\Query\Engine;

use RsORM\Query\Engine\MySQL\Clause;
use RsORM\Query\Engine\MySQL\Statement;

class MySQL {

    public function select(Clause\Objects $objects, Clause\From $table = null, Clause\Filter $filter = null, Clause\Group $group = null, Clause\Having $having = null, Clause\Order $order = null, Clause\Limit $limit = null, Clause\Flags $flags = null): Statement\Select {
        return new Statement\Select($objects, $table, $filter, $group, $having, $order, $limit, $flags);
    }

    public function delete(Clause\From $table, Clause\Filter $filter = null, Clause\Order $order = null, Clause\Limit $limit = null, Clause\Flags $flags = null): Statement\Delete {
        return new Statement\Delete($table, $filter, $order, $limit, $flags);
    }

    public function insert(Clause\Into $table, Clause\Values $values, Clause\Columns $columns = null, Clause\Returning $returning = null, Clause\Flags $flags = null): Statement\Insert {
        return new Statement\Insert($table, $values, $columns, $returning, $flags);
    }

    public function replace(Clause\Into $table, Clause\Values $values, Clause\Columns $columns = null, Clause\Returning $returning = null, Clause\Flags $flags = null): Statement\Replace {
        return new Statement\Replace($table, $values, $columns, $returning, $flags);
    }

    public function upsert(Clause\Into $table, Clause\Values $values, Clause\Columns $columns = null, Clause\Returning $returning = null, Clause\Flags $flags = null): Statement\Upsert {
        return new Statement\Upsert($table, $values, $columns, $returning, $flags);
    }

    public function update(Clause\Target $table, Clause\Set $set, Clause\Filter $filter = null, Clause\Order $order = null, Clause\Limit $limit = null, Clause\Flags $flags = null): Statement\Update {
        return new Statement\Update($table, $set, $filter, $order, $limit, $flags);
    }
    
}
