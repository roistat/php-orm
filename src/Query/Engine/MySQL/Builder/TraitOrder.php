<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Builder;

use RsORM\Query\Engine\MySQL;
use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Engine\MySQL\Clause;

trait TraitOrder {
    
    /**
     * @var MySQL\ObjectInterface[]
     */
    private $_orderObjects = [];
    
    /**
     * @param string $name
     * @param boolean $asc
     * @return BuilderInterface
     */
    public function order($name, $asc = true) {
        $column = new Argument\Column($name);
        $this->_orderObjects[] = $asc ? $column : new Argument\Desc($column);
        return $this;
    }
    
    /**
     * @return Clause\Order
     */
    protected function _buildOrder() {
        return $this->_orderObjects === [] ? null : new Clause\Order($this->_orderObjects);
    }
}
