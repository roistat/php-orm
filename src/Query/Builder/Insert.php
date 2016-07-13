<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Builder;

use RsORM\Query;
use RsORM\Query\Engine\MySQL;

class Insert extends AbstractBuilder {
    
    use TraitTarget, TraitFlags, TraitInsertData;
    
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
                $this->_buildTarget(),
                $this->_buildValues(),
                $this->_buildFields(),
                $this->_buildFlags());
    }
    
    /**
     * @return string
     */
    protected function _targetClass() {
        return MySQL\Clause\Into::getClassName();
    }
    
}
