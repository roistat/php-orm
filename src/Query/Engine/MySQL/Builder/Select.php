<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Builder;

use RsORM\Query;
use RsORM\Query\Engine\MySQL;
use RsORM\Query\Engine\MySQL\Flag;

/**
 * @method Select table(string $name)
 * @method Select where(Filter $filter)
 * @method Select group(string $name, boolean $asc)
 * @method Select having(Filter $filter)
 * @method Select order(string $name, boolean $asc)
 * @method Select limit(int $offset, int $count)
 * @method Select flagAll()
 * @method Select flagDelayed()
 * @method Select flagDistinct()
 * @method Select flagDistinctRow()
 * @method Select flagHighPriority()
 * @method Select flagIgnore()
 * @method Select flagLowPriority()
 * @method Select flagQuick()
 * @method Select flagSQLBigResult()
 * @method Select flagSQLBufferResult()
 * @method Select flagSQLCache()
 * @method Select flagSQLCalcFoundRows()
 * @method Select flagSQLNoCache()
 * @method Select flagSQLSmallResult()
 * @method Select flagStraightJoin()
 */
class Select implements BuilderInterface {
    
    use TraitObjects, TraitTable, TraitGroup, TraitLimit, TraitOrder, TraitFlags,
            TraitWhere, TraitHaving;
    
    /**
     * @param array $objects
     */
    public function __construct(array $objects = []) {
        $this->_setObjects($objects);
    }
    
    /**
     * @return MySQL\AbstractExpression
     */
    public function build() {
        return Query\Engine::mysql()->select(
                $this->_buildObjects(),
                $this->_buildTable(),
                $this->_buildWhere(),
                $this->_buildGroup(),
                $this->_buildHaving(),
                $this->_buildOrder(),
                $this->_buildLimit(),
                $this->_buildFlags()
                );
    }
    
    /**
     * @return string
     */
    protected function _tableClass() {
        return MySQL\Clause\From::getClassName();
    }
    
}
