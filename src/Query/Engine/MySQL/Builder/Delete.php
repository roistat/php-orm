<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Builder;

use RsORM\Query;
use RsORM\Query\Engine\MySQL;
use RsORM\Query\Engine\MySQL\Flag;

class Delete implements BuilderInterface {
    
    use TraitTable, TraitLimit, TraitOrder, TraitFlags,
            TraitWhere;
    
    /**
     * @return MySQL\AbstractExpression
     */
    public function build() {
        return Query\Engine::mysql()->delete(
                $this->_buildTarget(),
                $this->_buildWhere(),
                $this->_buildOrder(),
                $this->_buildLimit(),
                $this->_buildFlags());
    }
    
    /**
     * @return string
     */
    protected function _targetClass() {
        return MySQL\Clause\From::getClassName();
    }
    
}
