<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Builder;

use RsORM\Query;
use RsORM\Query\Engine\MySQL;
use RsORM\Query\Engine\MySQL\Flag;

/**
 * @method Update table(string $name)
 * @method Update where(Filter $filter)
 * @method Update order(string $name, boolean $asc)
 * @method Update limit(int $count, int $offset)
 * @method Update flagAll()
 * @method Update flagDelayed()
 * @method Update flagDistinct()
 * @method Update flagDistinctRow()
 * @method Update flagHighPriority()
 * @method Update flagIgnore()
 * @method Update flagLowPriority()
 * @method Update flagQuick()
 * @method Update flagSQLBigResult()
 * @method Update flagSQLBufferResult()
 * @method Update flagSQLCache()
 * @method Update flagSQLCalcFoundRows()
 * @method Update flagSQLNoCache()
 * @method Update flagSQLSmallResult()
 * @method Update flagStraightJoin()
 */
class Update implements BuilderInterface {
    
    use TraitTable, TraitFlags, TraitUpdateData, TraitWhere, TraitOrder, TraitLimit;
    
    /**
     * @param array $data
     */
    public function __construct(array $data) {
        $this->_setUpdateData($data);
    }
    
    /**
     * @return MySQL\Statement\AbstractStatement
     */
    public function build() {
        return Query\Engine::mysql()->update(
                $this->_table === null ? null : new MySQL\Clause\Target($this->_table),
                $this->_buildSet(),
                $this->_buildWhere(),
                $this->_buildOrder(),
                $this->_buildLimit(),
                $this->_buildFlags());
    }
}
