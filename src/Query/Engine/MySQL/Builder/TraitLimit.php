<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Builder;

use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Engine\MySQL\Clause;

trait TraitLimit {
    
    /**
     * @var int
     */
    private $_offset;
    
    /**
     * @var int
     */
    private $_count;

    public function limit(?int $count = null, ?int $offset = null): self {
        $this->_offset = $offset;
        $this->_count = $count;
        return $this;
    }

    protected function _buildLimit(): ?Clause\Limit {
        if ($this->_offset === null && $this->_count === null) {
            return null;
        }
        $count = ($this->_count === null) ? null : new Argument\Value($this->_count);
        $offset = ($this->_offset === null) ? null : new Argument\Value($this->_offset);
        return new Clause\Limit($count, $offset);
    }
}
