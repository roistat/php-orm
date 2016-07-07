<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Builder;

use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Engine\MySQL\Condition;
use RsORM\Query\Engine\MySQL;

class Filter implements BuilderInterface {
    
    /**
     * @var array
     */
    private $_stack = [[]];
    
    /**
     * @var int
     */
    private $_pos = 0;
    
    /**
     * @param string $column
     * @param int|double|string $expected
     * @param boolean $is
     * @return Filter
     */
    public function eq($column, $expected, $is = true) {
        $arg1 = new Argument\Column($column);
        $arg2 = new Argument\Value($expected);
        if ($is) {
            $this->_stack[$this->_pos][] = new Condition\Equal($arg1, $arg2);
        } else {
            $this->_stack[$this->_pos][] = new Condition\NotEqual($arg1, $arg2);
        }
        return $this;
    }
    
    /**
     * @return Filter
     */
    public function _or() {
        $this->_stack[] = [];
        $this->_pos++;
        return $this;
    }
    
    /**
     * @return MySQL\ObjectInterface
     */
    public function build() {
        $stack = [];
        foreach ($this->_stack as $conditions) {
            if (count($conditions) === 1) {
                $stack[] = $conditions[0];
            } elseif (count($conditions) > 1) {
                $stack[] = new Condition\LogicalAnd($conditions);
            }
        }
        if (count($stack) === 1) {
            return $stack[0];
        } elseif (count($stack) > 1) {
            return new Condition\LogicalOr($stack);
        } else {
            return null;
        }
    }
}
