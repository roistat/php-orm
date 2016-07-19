<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Builder;

use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Engine\MySQL\Clause;

trait TraitTable {
    
    /**
     * @var Argument\Table
     */
    protected $_table;
    
    /**
     * @param string $name
     * @return BuilderInterface
     */
    public function table($name) {
        $this->_table = new Argument\Table($name);
        return $this;
    }
}
