<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Builder;

use RsORM\Query\Engine\MySQL\Flag;
use RsORM\Query\Engine\MySQL\Clause;

trait TraitFlags {
    
    /**
     * @var Flag\AbstractFlag[]
     */
    private $_flags = [];
    
    /**
     * @param Flag\AbstractFlag[] $flags
     * @return AbstractBuilder
     */
    public function flags(array $flags) {
        $this->_flags = $flags;
        return $this;
    }
    
    /**
     * @return Clause\Flags
     */
    protected function _buildFlags() {
        return $this->_buildClause($this->_flags, Clause\Flags::class);
    }
}
