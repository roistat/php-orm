<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Builder;

use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Engine\MySQL\Clause;

trait TraitTarget {
    
    /**
     * @var Argument\Table
     */
    private $_table;
    
    /**
     * @return string
     */
    abstract protected function _targetClass();
    
    /**
     * @param string $name
     * @return AbstractBuilder
     */
    public function table($name) {
        $this->_table = new Argument\Table($name);
        return $this;
    }
    
    /**
     * @return Clause\Target|Clause\From|Clause\Into
     */
    protected function _buildTarget() {
        return $this->_buildClause($this->_table, $this->_targetClass());
    }
}
