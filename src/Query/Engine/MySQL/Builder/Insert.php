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
class Insert implements BuilderInterface {
    
    use TraitTable, TraitFlags, TraitInsertData;
    
    /**
     * @param array $data
     */
    public function __construct(array $data) {
        $this->_setInsertData($data);
    }
    
    /**
     * @return MySQL\AbstractExpression
     */
    public function build() {
        return Query\Engine::mysql()->insert(
                $this->_table === null ? null : new MySQL\Clause\Into($this->_table),
                $this->_buildValues(),
                $this->_buildFields(),
                $this->_buildFlags());
    }
}
