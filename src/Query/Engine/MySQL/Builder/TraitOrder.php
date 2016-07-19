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
     * @param array $fields
     * @return BuilderInterface
     */
    public function order(array $fields) {
        foreach ($fields as $field) {
            if ($field instanceof MySQL\ObjectInterface) {
                $this->_orderObjects[] = $field;
            } elseif (is_string($field)) {
                $this->_orderObjects[] = new Argument\Column($field);
            }
        }
        return $this;
    }
    
    /**
     * @return Clause\Order
     */
    protected function _buildOrder() {
        return $this->_orderObjects === [] ? null : new Clause\Order($this->_orderObjects);
    }
}
