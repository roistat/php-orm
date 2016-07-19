<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Builder;

use RsORM\Query\Engine\MySQL;
use RsORM\Query\Engine\MySQL\Clause;
use RsORM\Query\Engine\MySQL\Argument;

trait TraitGroup {
    
    /**
     * @var MySQL\ObjectInterface[]
     */
    private $_groupObjects = [];
    
    /**
     * @param string $name
     * @param boolean $asc
     * @return BuilderInterface
     */
    public function group($name, $asc = true) {
        $column = new Argument\Column($name);
        $this->_groupObjects[] = $asc ? $column : new Argument\Desc($column);
        return $this;
    }
    
    /**
     * @return Clause\Group
     */
    protected function _buildGroup() {
        return $this->_groupObjects === [] ? null : new Clause\Group($this->_groupObjects);
    }
}
