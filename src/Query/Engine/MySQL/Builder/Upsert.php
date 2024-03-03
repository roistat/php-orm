<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Builder;

use RsORM\Query;
use RsORM\Query\Engine\MySQL;
use RsORM\Query\Engine\MySQL\Flag;

/**
 * @method Upsert table(string $name)
 * @method Upsert returning(string $name)
 * @method Upsert flagAll()
 * @method Upsert flagDelayed()
 * @method Upsert flagDistinct()
 * @method Upsert flagDistinctRow()
 * @method Upsert flagHighPriority()
 * @method Upsert flagIgnore()
 * @method Upsert flagLowPriority()
 * @method Upsert flagQuick()
 * @method Upsert flagSQLBigResult()
 * @method Upsert flagSQLBufferResult()
 * @method Upsert flagSQLCache()
 * @method Upsert flagSQLCalcFoundRows()
 * @method Upsert flagSQLNoCache()
 * @method Upsert flagSQLSmallResult()
 * @method Upsert flagStraightJoin()
 */
class Upsert implements BuilderInterface {
    use TraitTable, TraitFlags, TraitInsertData, TraitReturning;
    
    /**
     * @param array $data
     */
    public function __construct(array $data) {
        $this->_setInsertData($data);
    }
    
    /**
     * @return MySQL\Statement\AbstractStatement
     */
    public function build() {
        return Query\Engine::mysql()->upsert(
                $this->_table === null ? null : new MySQL\Clause\Into($this->_table),
                $this->_buildValues(),
                $this->_buildColumns(),
                $this->_buildReturning(),
                $this->_buildFlags());
    }
}
