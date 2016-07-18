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
    
    /**
     * @param int $offset
     * @param int $count
     * @return $this
     */
    public function limit($offset, $count = null) {
        $this->_offset = $offset;
        $this->_count = $count;
        return $this;
    }
    
    /**
     * @return Clause\Limit
     */
    protected function _buildLimit() {
        if ($this->_offset === null) {
            return null;
        }
        $offset = new Argument\Value($this->_offset);
        $count = ($this->_count === null) ? null : new Argument\Value($this->_count);
        return new Clause\Limit($offset, $count);
    }
}
