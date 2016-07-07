<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Builder;

use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Engine\MySQL\Clause;
use RsORM\Query\Engine\MySQL;

class Order implements BuilderInterface {
    
    /**
     * @var MySQL\ObjectInterface[]
     */
    private $_objects = [];
    
    /**
     * @param string $name
     * @param boolean $asc
     */
    public function set($name, $asc = true) {
        $column = new Argument\Column($name);
        if ($asc) {
            $this->_objects[] = $column;
        } else {
            $this->_objects[] = new Argument\Desc($column);
        }
    }
    
    /**
     * @return Clause\Order
     */
    public function build() {
        if ($this->_objects === []) {
            return null;
        } else {
            return new Clause\Order($this->_objects);
        }
    }
}
