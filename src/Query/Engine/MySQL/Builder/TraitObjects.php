<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Builder;

use RsORM\Query\Engine\MySQL;
use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Engine\MySQL\Clause;

trait TraitObjects {
    
    /**
     * @var MySQL\ObjectInterface[]
     */
    private $_objects = [];

    /**
     * @param MySQL\ObjectInterface[] $objects
     */
    protected function _setObjects(array $objects) {
        $this->_objects = [];
        foreach ($objects as $object) {
            $this->_setObject($object);
        }
    }

    /**
     * @param MySQL\ObjectInterface|string $object
     * @param string $alias
     */
    protected function _setObject($object, $alias = null) {
        $sqlObject = $object instanceof MySQL\ObjectInterface ? $object : new Argument\Column($object);
        if ($alias === null) {
            $this->_objects[] = new Argument\Field($sqlObject);
        } else {
            $this->_objects[] = new Argument\Field($sqlObject, new Argument\Alias($alias));
        }
    }


    /**
     * @return Clause\Objects
     */
    protected function _buildObjects() {
        $objects = $this->_objects === [] ? [new Argument\Any()] : $this->_objects;
        return new Clause\Objects($objects);
    }
}
