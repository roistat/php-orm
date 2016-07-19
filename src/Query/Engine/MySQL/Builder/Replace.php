<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Builder;

use RsORM\Query;
use RsORM\Query\Engine\MySQL;
use RsORM\Query\Engine\MySQL\Flag;

/**
 * @method Replace table(string $name)
 * @method Replace flags(Flag\AbstractFlag[] $flags)
 */
class Replace implements BuilderInterface {
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
        return Query\Engine::mysql()->replace(
                $this->_table === null ? null : new MySQL\Clause\Into($this->_table),
                $this->_buildValues(),
                $this->_buildFields(),
                $this->_buildFlags());
    }
}
