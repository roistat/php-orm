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
 * @method Update order(array $fields)
 * @method Update limit(int $offset, int $count)
 * @method Update flags(Flag\AbstractFlag[] $flags)
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
     * @return MySQL\AbstractExpression
     */
    public function build() {
        return Query\Engine::mysql()->update(
                $this->_buildTarget(),
                $this->_buildSet(),
                $this->_buildWhere(),
                $this->_buildOrder(),
                $this->_buildLimit(),
                $this->_buildFlags());
    }
    
    /**
     * @return string
     */
    protected function _targetClass() {
        return MySQL\Clause\Target::getClassName();
    }
    
}
