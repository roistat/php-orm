<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Builder\Clause;

use RsORM\Query\Builder;
use RsORM\Query\Engine\MySQL\Flag;
use RsORM\Query\Engine\MySQL\Clause;

class Flags implements Builder\BuilderInterface {
    
    /**
     * @var Flag\AbstractFlag[]
     */
    private $_flags = [];
    
    /**
     * @param Flag\AbstractFlag $flag
     */
    public function set(Flag\AbstractFlag $flag) {
        $this->_flags[] = $flag;
    }
    
    /**
     * @return Clause\Flags
     */
    public function build() {
        if ($this->_flags === []) {
            return null;
        }
        return new Clause\Flags($this->_flags);
    }
}
