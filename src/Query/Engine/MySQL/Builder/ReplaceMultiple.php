<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Builder;

use RsORM\Query;
use RsORM\Query\Engine\MySQL;
use RsORM\Query\Engine\MySQL\Flag;

/**
 * @method ReplaceMultiple table(string $name)
 * @method ReplaceMultiple returning(string $name)
 * @method ReplaceMultiple flagAll()
 * @method ReplaceMultiple flagDelayed()
 * @method ReplaceMultiple flagDistinct()
 * @method ReplaceMultiple flagDistinctRow()
 * @method ReplaceMultiple flagHighPriority()
 * @method ReplaceMultiple flagIgnore()
 * @method ReplaceMultiple flagLowPriority()
 * @method ReplaceMultiple flagQuick()
 * @method ReplaceMultiple flagSQLBigResult()
 * @method ReplaceMultiple flagSQLBufferResult()
 * @method ReplaceMultiple flagSQLCache()
 * @method ReplaceMultiple flagSQLCalcFoundRows()
 * @method ReplaceMultiple flagSQLNoCache()
 * @method ReplaceMultiple flagSQLSmallResult()
 * @method ReplaceMultiple flagStraightJoin()
 */
class ReplaceMultiple extends Replace {
    
    /**
     * @param array $data
     */
    public function __construct(array $data) {
        parent::__construct([]);
        $this->_setInsertDataMultiple($data);
    }
}
