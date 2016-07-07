<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Builder;

use RsORM\Query;
use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Engine\MySQL\Clause;
use RsORM\Query\Engine\MySQL;
use RsORM\Query\Engine\MySQL\Func;

class Select implements BuilderInterface {
    
    /**
     * @var MySQL\ObjectInterface[]
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
     * @var Filter
     */
    private $_having;
    
    /**
     * @var Limit
     */
    private $_limit;
    
    /**
     * @var Order
     */
    private $_order;
    
    /**
     * @var Group
     */
    private $_group;
    
    /**
     * @param string[] $objects
     */
    public function __construct(array $objects = []) {
        $this->_group = new Group();
        $this->_limit = new Limit();
        $this->_order = new Order();
        foreach ($objects as $object) {
            $this->_objects[] = new Argument\Column($object);
        }
    }
    
    /**
     * @param string $columnName
     * @param string $aliasName
     * @param boolean $distinct
     * @return Select
     */
    public function funcCount($columnName, $aliasName, $distinct = false) {
        $column = new Argument\Column($columnName);
        $alias = new Argument\Alias($aliasName);
        $func = new Func\Count($column, $distinct);
        $this->_objects[] = new Argument\Field($func, $alias);
        return $this;
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
    
    public function limit($offset, $count) {
        $this->_limit->set($offset, $count);
        return $this;
    }
    
    public function order($name, $asc = true) {
        $this->_order->set($name, $asc);
        return $this;
    }
    
    public function group($name, $asc = true) {
        $this->_group->set($name, $asc);
        return $this;
    }
    
    /**
     * @return MySQL\AbstractExpression
     */
    public function build() {
        if ($this->_objects === []) {
            $objects = new Clause\Objects([new Argument\Any()]);
        } else {
            $objects = new Clause\Objects($this->_objects);
        }
        $condition = $this->_filter ? $this->_filter->build() : null;
        if ($condition === null) {
            $filter = null;
        } else {
            $filter = new Clause\Filter($condition);
        }
        $condition = $this->_having ? $this->_having->build() : null;
        if ($condition === null) {
            $having = null;
        } else {
            $having = new Clause\Having($condition);
        }
        $flags = null;
        return Query\Engine::mysql()->select(
                $objects,
                $this->_table,
                $filter,
                $this->_group->build(),
                $having,
                $this->_order->build(),
                $this->_limit->build(),
                $flags
                );
    }
    
}
