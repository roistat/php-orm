<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Builder;

/**
 * @method UpsertMultiple table(string $name)
 * @method UpsertMultiple returning(string $name)
 * @method UpsertMultiple flagAll()
 * @method UpsertMultiple flagDelayed()
 * @method UpsertMultiple flagDistinct()
 * @method UpsertMultiple flagDistinctRow()
 * @method UpsertMultiple flagHighPriority()
 * @method UpsertMultiple flagIgnore()
 * @method UpsertMultiple flagLowPriority()
 * @method UpsertMultiple flagQuick()
 * @method UpsertMultiple flagSQLBigResult()
 * @method UpsertMultiple flagSQLBufferResult()
 * @method UpsertMultiple flagSQLCache()
 * @method UpsertMultiple flagSQLCalcFoundRows()
 * @method UpsertMultiple flagSQLNoCache()
 * @method UpsertMultiple flagSQLSmallResult()
 * @method UpsertMultiple flagStraightJoin()
 */
class UpsertMultiple extends Upsert {
    
    /**
     * @param array $data
     */
    public function __construct(array $data) {
        parent::__construct([]);
        $this->_setInsertDataMultiple($data);
    }
}
