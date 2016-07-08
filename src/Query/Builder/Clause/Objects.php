<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Builder\Clause;

use RsORM\Query\Builder;
use RsORM\Query\Engine\MySQL\Clause;
use RsORM\Query\Engine\MySQL;
use RsORM\Query\Engine\MySQL\Argument;

class Objects implements Builder\BuilderInterface {
    
    /**
     * @var MySQL\ObjectInterface[]
     */
    private $_objects = [];
    
    /**
     * @param array $objects
     */
    public function set(array $objects) {
        foreach ($objects as $object) {
            if (is_string($object)) {
                $this->_objects[] = new Argument\Column($object);
            } elseif ($object instanceof MySQL\ObjectInterface) {
                $this->_objects[] = $object;
            }
        }
    }
    
    /**
     * @return Clause\Objects
     */
    public function build() {
        $objects = $this->_objects === [] ? new Argument\Any() : $this->_objects;
        return new Clause\Objects($objects);
    }
}
