<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Builder;

use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Engine\MySQL\Clause;

trait TraitTable {
    
    /**
     * @var Argument\Table
     */
    private $_table;

    /**
     * @param string $name
     * @return $this
     */
    public function table($name) {
        $this->_table = new Argument\Table($name);
        return $this;
    }
}
