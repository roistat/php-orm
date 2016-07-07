<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Builder;

use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Engine\MySQL\Clause;

class Limit implements BuilderInterface {
    
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
     */
    public function set($offset, $count) {
        $this->_offset = $offset;
        $this->_count = $count;
    }
    
    /**
     * @return Clause\Limit
     */
    public function build() {
        return new Clause\Limit(
                new Argument\Value($this->_offset),
                new Argument\Value($this->_count)
                );
    }
}
