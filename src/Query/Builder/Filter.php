<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Builder;

use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Engine\MySQL\Condition;
use RsORM\Query\Engine\MySQL;
use RsORM\Query\Engine\MySQL\Operator;

class Filter extends AbstractBuilder {
    
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
     * @param mixed $expected
     * @param boolean $is
     * @return Filter
     */
    public function compare($column, $expected, $is = true) {
        switch (gettype($expected)) {
            case "integer":
            case "double":
                return $this->eq($column, $expected, $is);
            case "string":
                return $this->like($column, $expected, $is);
            case "boolean":
                return $this->is($column, $expected, $is);
            case "NULL":
                return $this->isNull($column, $is);
            case "array":
                return $this->in($column, $expected, $is);
        }
    }
    
    /**
     * @param string $column
     * @param int|double|string $expected
     * @param boolean $is
     * @return Filter
     */
    public function eq($column, $expected, $is = true) {
        return $this->_addCondition(Condition\Equal::class, [$column, $expected], $is, Condition\NotEqual::class);
    }
    
    /**
     * @param string $column
     * @param int|double $min
     * @param int|double $max
     * @param boolean $is
     * @return Filter
     */
    public function between($column, $min, $max, $is = true) {
        return $this->_addCondition(Condition\Between::class, [$column, $min, $max], $is);
    }
    
    /**
     * @param string $column
     * @param array $set
     * @param boolean $is
     * @return Filter
     */
    public function in($column, array $set, $is = true) {
        return $this->_addCondition(Condition\In::class, [$column, $set], $is);
    }
    
    /**
     * @param string $column
     * @param string $expected
     * @param boolean $is
     * @return Filter
     */
    public function like($column, $expected, $is = true) {
        return $this->_addCondition(Condition\Like::class, [$column, $expected], $is);
    }
    
    /**
     * @param string $column
     * @param int|double $expected
     * @param boolean $is
     * @return Filter
     */
    public function gt($column, $expected, $is = true) {
        return $this->_addCondition(Condition\Gt::class, [$column, $expected], $is);
    }
    
    /**
     * @param string $column
     * @param int|double $expected
     * @param boolean $is
     * @return Filter
     */
    public function gte($column, $expected, $is = true) {
        return $this->_addCondition(Condition\Gte::class, [$column, $expected], $is);
    }
    
    /**
     * @param string $column
     * @param int|double $expected
     * @param boolean $is
     * @return Filter
     */
    public function lt($column, $expected, $is = true) {
        return $this->_addCondition(Condition\Lt::class, [$column, $expected], $is);
    }
    
    /**
     * @param string $column
     * @param int|double $expected
     * @param boolean $is
     * @return Filter
     */
    public function lte($column, $expected, $is = true) {
        return $this->_addCondition(Condition\Lte::class, [$column, $expected], $is);
    }
    
    /**
     * @param string $column
     * @param mixed $expected
     * @param boolean $is
     * @return Filter
     */
    public function is($column, $expected, $is = true) {
        return $this->_addCondition(Condition\Is::class, [$column, $expected], $is, Condition\IsNot::class);
    }
    
    /**
     * @param string $column
     * @param boolean $is
     * @return Filter
     */
    public function isNull($column, $is = true) {
        return $this->_addCondition(Condition\IsNull::class, [$column], $is, Condition\IsNotNull::class);
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
    
    /**
     * @param string $class
     * @param array $args
     * @param boolean $is
     * @param string $negativeClass
     * @return Filter
     */
    private function _addCondition($class, array $args = [], $is = true, $negativeClass = null) {
        $column = new Argument\Column(array_shift($args));
        $formedArgs = $this->_parseArgs($args);
        if ($is) {
            $this->_conditions[] = new $class($column, ...$formedArgs);
        } elseif ($negativeClass === null) {
            $this->_conditions[] = new Condition\LogicalNot(new $class($column, ...$formedArgs));
        } else {
            $this->_conditions[] = new $negativeClass($column, ...$formedArgs);
        }
        return $this;
    }
    
    /**
     * @param array $args
     * @return array
     */
    private function _parseArgs(array $args) {
        $parsedArgs = [];
        foreach ($args as $arg) {
            if (is_array($arg)) {
                $parsedArgs[] = $this->_parseArgs($arg);
            } else {
                $parsedArgs[] = new Argument\Value($arg);
            }
        }
        return $parsedArgs;
    }
}
