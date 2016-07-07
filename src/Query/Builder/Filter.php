<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Builder;

use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Engine\MySQL\Condition;
use RsORM\Query\Engine\MySQL;
use RsORM\Query\Engine\MySQL\Operator;

class Filter implements BuilderInterface {
    
    /**
     * @var Operator\AbstractOperator[]
     */
    private $_conditions = [];
    
    /**
     * @var Filter[]
     */
    private $_filters = [];
    
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
            $this->_conditions[] = new Condition\Equal($arg1, $arg2);
        } else {
            $this->_conditions[] = new Condition\NotEqual($arg1, $arg2);
        }
        return $this;
    }
    
    /**
     * @return Filter
     */
    public function logicOr(Filter $filter) {
        $this->_filters[] = $filter;
        return $this;
    }
    
    /**
     * @return MySQL\ObjectInterface
     */
    public function build() {
        $filters = [];
        if (count($this->_conditions) === 1) {
            $filters[] = $this->_conditions[0];
        } elseif(count($this->_conditions) > 1) {
            $filters[] = new Condition\LogicalAnd($this->_conditions);
        }
        foreach ($this->_filters as $filter) {
            $filters[] = $filter->build();
        }
        if (count($filters) === 1) {
            return $filters[0];
        } elseif (count($filters) > 1) {
            return new Condition\LogicalOr($filters);
        } else {
            return null;
        }
    }
}
