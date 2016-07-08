<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Builder;

use RsORM\Query;
use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Engine\MySQL;
use RsORM\Query\Engine\MySQL\Func;
use RsORM\Query\Builder\Clause;
use RsORM\Query\Engine\MySQL\Flag;

class Select implements BuilderInterface {
    
    /**
     * @var Clause\Objects
     */
    private $_objects;
    
    /**
     * @var Clause\Target
     */
    private $_target;
    
    /**
     * @var Clause\Condition
     */
    private $_where;
    
    /**
     * @var Clause\Condition
     */
    private $_having;
    
    /**
     * @var Clause\Limit
     */
    private $_limit;
    
    /**
     * @var Clause\Order
     */
    private $_order;
    
    /**
     * @var Clause\Group
     */
    private $_group;
    
    /**
     * @var Clause\Flags
     */
    private $_flags;
    
    /**
     * @param string[] $objects
     */
    public function __construct(array $objects = []) {
        $this->_objects = new Clause\Objects();
        $this->_target = new Clause\Target(Clause\Target::FROM);
        $this->_where = new Clause\Condition(Clause\Condition::WHERE);
        $this->_having = new Clause\Condition(Clause\Condition::HAVING);
        $this->_group = new Clause\Group();
        $this->_limit = new Clause\Limit();
        $this->_order = new Clause\Order();
        $this->_flags = new Clause\Flags();
        $this->_objects->set($objects);
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
        $this->_objects->set([new Argument\Field($func, $alias)]);
        return $this;
    }
    
    /**
     * @param string $table
     * @return Select
     */
    public function from($table) {
        $this->_target->set($table);
        return $this;
    }
    
    /**
     * @param Filter $filter
     * @return Select
     */
    public function where(Filter $filter) {
        $this->_where->set($filter);
        return $this;
    }
    
    /**
     * @param int $offset
     * @param int $count
     * @return Select
     */
    public function limit($offset, $count) {
        $this->_limit->set($offset, $count);
        return $this;
    }
    
    /**
     * @param string $name
     * @param boolean $asc
     * @return Select
     */
    public function order($name, $asc = true) {
        $this->_order->set($name, $asc);
        return $this;
    }
    
    /**
     * @param string $name
     * @param boolean $asc
     * @return Select
     */
    public function group($name, $asc = true) {
        $this->_group->set($name, $asc);
        return $this;
    }
    
    /**
     * @param Filter $filter
     * @return Select
     */
    public function having(Filter $filter) {
        $this->_having->set($filter);
        return $this;
    }
    
    /**
     * @param Flag\AbstractFlag $flag
     * @return Select
     */
    public function flag(Flag\AbstractFlag $flag) {
        $this->_flags->set($flag);
        return $this;
    }
    
    /**
     * @return MySQL\AbstractExpression
     */
    public function build() {
        return Query\Engine::mysql()->select(
                $this->_objects->build(),
                $this->_target->build(),
                $this->_where->build(),
                $this->_group->build(),
                $this->_having->build(),
                $this->_order->build(),
                $this->_limit->build(),
                $this->_flags->build()
                );
    }
    
}
