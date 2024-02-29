<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Builder;

use RsORM\Query;
use RsORM\Query\Engine\MySQL;
use RsORM\Query\Engine\MySQL\Flag;

/**
 * @method Insert table(string $name)
 * @method Insert returning(string $name)
 * @method Insert flagAll()
 * @method Insert flagDelayed()
 * @method Insert flagDistinct()
 * @method Insert flagDistinctRow()
 * @method Insert flagHighPriority()
 * @method Insert flagIgnore()
 * @method Insert flagLowPriority()
 * @method Insert flagQuick()
 * @method Insert flagSQLBigResult()
 * @method Insert flagSQLBufferResult()
 * @method Insert flagSQLCache()
 * @method Insert flagSQLCalcFoundRows()
 * @method Insert flagSQLNoCache()
 * @method Insert flagSQLSmallResult()
 * @method Insert flagStraightJoin()
 */
class InsertMultiple extends Insert {

    /**
     * @param array $data
     */
    public function __construct(array $data) {
        parent::__construct([]);
        $this->_setInsertDataMultiple($data);
    }
}
