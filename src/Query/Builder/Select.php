<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Builder;

use RsORM\Query;
use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Engine\MySQL\Clause;
use RsORM\Query\Engine\MySQL;

class Select implements BuilderInterface {
    
    /**
     * @var Clause\Objects
     */
    private $_objects;
    
    /**
     * @var Clause\From
     */
    private $_table;
    
    /**
     * @var Filter
     */
    private $_filter;
    
    /**
     * @param string[] $objects
     */
    public function __construct(array $objects = null) {
        if ($objects === null) {
            $this->_objects = new Clause\Objects([
                new Argument\Any(),
            ]);
            return;
        }
        $mysqlObjects = [];
        foreach ($objects as $object) {
            $mysqlObjects[] = new Argument\Column($object);
        }
        $this->_objects = new Clause\Objects($mysqlObjects);
    }
    
    /**
     * @param string $table
     * @return Select
     */
    public function from($table) {
        $this->_table = new Clause\From(new Argument\Table($table));
        return $this;
    }
    
    /**
     * @param Filter $filter
     * @return Select
     */
    public function where(Filter $filter) {
        $this->_filter = $filter;
        return $this;
    }
    
    public function whereEq($column, $expected, $is = true) {
        if ($this->_filter === null) {
            $this->_filter = new Filter();
        }
        $this->_filter->eq($column, $expected, $is);
        return $this;
    }
    
    public function whereOr() {
        if ($this->_filter === null) {
            $this->_filter = new Filter();
        }
        $this->_filter->_or();
        return $this;
    }
    
    /**
     * @return MySQL\AbstractExpression
     */
    public function build() {
        $condition = $this->_filter->build();
        if ($condition === null) {
            $filter = null;
        } else {
            $filter = new Clause\Filter($condition);
        }
        return Query\Engine::mysql()->select($this->_objects, $this->_table, $filter);
    }
}
