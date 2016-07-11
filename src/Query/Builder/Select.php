<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Builder;

use RsORM\Query;
use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Engine\MySQL;
use RsORM\Query\Engine\MySQL\Func;
use RsORM\Query\Engine\MySQL\Flag;
//use RsORM\Query\Engine\MySQL\Clause;

/**
 * @method Select table(string $name)
 */
class Select extends AbstractBuilder {
    
    use TraitObjects, TraitTarget, TraitGroup, TraitLimit, TraitOrder, TraitFlags,
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
                $this->_buildTarget(),
                $this->_buildWhere(),
                $this->_buildGroup(),
                $this->_buildHaving(),
                $this->_buildOrder(),
                $this->_buildLimit(),
                $this->_buildFlags()
                );
    }
    
    protected function _targetClass() {
        return MySQL\Clause\From::class;
    }
    
}
