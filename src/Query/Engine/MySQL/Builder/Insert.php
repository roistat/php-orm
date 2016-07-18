<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Builder;

use RsORM\Query;
use RsORM\Query\Engine\MySQL;
use RsORM\Query\Engine\MySQL\Flag;
use RsORM\Query\Engine\MySQL\Clause;

/**
 * @method Insert table(string $name)
 * @method Insert flags(Flag\AbstractFlag[] $flags)
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
                $this->_buildTable(),
                $this->_buildValues(),
                $this->_buildFields(),
                $this->_buildFlags());
    }
    
    /**
     * @return string
     */
    protected function _targetClass() {
        return Clause\Into::getClassName();
    }
    
}
