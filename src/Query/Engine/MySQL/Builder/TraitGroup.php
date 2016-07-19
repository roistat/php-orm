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
     * @param array $fields
     * @return BuilderInterface
     */
    public function group(array $fields) {
        foreach ($fields as $field) {
            if ($field instanceof MySQL\ObjectInterface) {
                $this->_groupObjects[] = $field;
            } elseif (is_string($field)) {
                $this->_groupObjects[] = new Argument\Column($field);
            }
        }
        return $this;
    }
    
    /**
     * @return Clause\Group
     */
    protected function _buildGroup() {
        return $this->_groupObjects === [] ? null : new Clause\Group($this->_groupObjects);
    }
}
