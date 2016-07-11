<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Builder;

use RsORM\Query\Engine\MySQL;
use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Engine\MySQL\Clause;

trait TraitObjects {
    
    /**
     * @var MySQL\ObjectInterface[]
     */
    private $_objects = [];
    
    /**
     * @param string|MySQL\ObjectInterface $object
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
     * @param string[] $objects
     */
    protected function _setObjects(array $objects) {
        foreach ($objects as $object) {
            $this->_setObject($object);
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
