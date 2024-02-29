<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Builder;

use RsORM\Query;
use RsORM\Query\Engine\MySQL;
use RsORM\Query\Engine\MySQL\Flag;

/**
 * @method Replace table(string $name)
 * @method Insert returning(string $name)
 * @method Replace flagAll()
 * @method Replace flagDelayed()
 * @method Replace flagDistinct()
 * @method Replace flagDistinctRow()
 * @method Replace flagHighPriority()
 * @method Replace flagIgnore()
 * @method Replace flagLowPriority()
 * @method Replace flagQuick()
 * @method Replace flagSQLBigResult()
 * @method Replace flagSQLBufferResult()
 * @method Replace flagSQLCache()
 * @method Replace flagSQLCalcFoundRows()
 * @method Replace flagSQLNoCache()
 * @method Replace flagSQLSmallResult()
 * @method Replace flagStraightJoin()
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
