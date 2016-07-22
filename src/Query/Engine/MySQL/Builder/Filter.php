<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Builder;

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
        $operand1 = $this->_parseColumn($column);
        $operand2 = $this->_parseValue($expected);
        $this->_conditions[] = $is ? new Condition\Equal($operand1, $operand2) : new Condition\NotEqual($operand1, $operand2);
        return $this;
    }
    
    /**
     * @param string $column
     * @param int|double $min
     * @param int|double $max
     * @param boolean $is
     * @return Filter
     */
    public function between($column, $min, $max, $is = true) {
        $columnObject = $this->_parseColumn($column);
        $minValue = $this->_parseValue($min);
        $maxValue = $this->_parseValue($max);
        $condition = new Condition\Between($columnObject, $minValue, $maxValue);
        $this->_conditions[] = $is ? $condition : new Condition\LogicalNot($condition);
        return $this;
    }
    
    /**
     * @param string $column
     * @param array $set
     * @param boolean $is
     * @return Filter
     */
    public function in($column, array $set, $is = true) {
        $columnObject = $this->_parseColumn($column);
        $parsedSet = $this->_parseValues($set);
        $condition = new Condition\In($columnObject, $parsedSet);
        $this->_conditions[] = $is ? $condition : new Condition\LogicalNot($condition);
        return $this;
    }
    
    /**
     * @param string $column
     * @param string $expected
     * @param boolean $is
     * @return Filter
     */
    public function like($column, $expected, $is = true) {
        $parsedColumn = $this->_parseColumn($column);
        $parsedExpected = $this->_parseValue($expected);
        $condition = new Condition\Like($parsedColumn, $parsedExpected);
        $this->_conditions[] = $is ? $condition : new Condition\LogicalNot($condition);
        return $this;
    }
    
    /**
     * @param string $column
     * @param int|double $expected
     * @param boolean $is
     * @return Filter
     */
    public function gt($column, $expected, $is = true) {
        $parsedColumn = $this->_parseColumn($column);
        $parsedExpected = $this->_parseValue($expected);
        $condition = new Condition\Gt($parsedColumn, $parsedExpected);
        $this->_conditions[] = $is ? $condition : new Condition\LogicalNot($condition);
        return $this;
    }
    
    /**
     * @param string $column
     * @param int|double $expected
     * @param boolean $is
     * @return Filter
     */
    public function gte($column, $expected, $is = true) {
        $parsedColumn = $this->_parseColumn($column);
        $parsedExpected = $this->_parseValue($expected);
        $condition = new Condition\Gte($parsedColumn, $parsedExpected);
        $this->_conditions[] = $is ? $condition : new Condition\LogicalNot($condition);
        return $this;
    }
    
    /**
     * @param string $column
     * @param int|double $expected
     * @param boolean $is
     * @return Filter
     */
    public function lt($column, $expected, $is = true) {
        $parsedColumn = $this->_parseColumn($column);
        $parsedExpected = $this->_parseValue($expected);
        $condition = new Condition\Lt($parsedColumn, $parsedExpected);
        $this->_conditions[] = $is ? $condition : new Condition\LogicalNot($condition);
        return $this;
    }
    
    /**
     * @param string $column
     * @param int|double $expected
     * @param boolean $is
     * @return Filter
     */
    public function lte($column, $expected, $is = true) {
        $parsedColumn = $this->_parseColumn($column);
        $parsedExpected = $this->_parseValue($expected);
        $condition = new Condition\Lte($parsedColumn, $parsedExpected);
        $this->_conditions[] = $is ? $condition : new Condition\LogicalNot($condition);
        return $this;
    }
    
    /**
     * @param string $column
     * @param mixed $expected
     * @param boolean $is
     * @return Filter
     */
    public function is($column, $expected, $is = true) {
        $parsedColumn = $this->_parseColumn($column);
        $parsedExpected = $this->_parseValue($expected);
        $this->_conditions[] = $is ? new Condition\Is($parsedColumn, $parsedExpected) : new Condition\IsNot($parsedColumn, $parsedExpected);
        return $this;
    }
    
    /**
     * @param string $column
     * @param boolean $is
     * @return Filter
     */
    public function isNull($column, $is = true) {
        $parsedColumn = $this->_parseColumn($column);
        $this->_conditions[] = $is ? new Condition\IsNull($parsedColumn) : new Condition\IsNotNull($parsedColumn);
        return $this;
    }
    
    /**
     * @param Filter $filter
     * @return Filter
     */
    public function logicOr(Filter $filter) {
        $this->_filters[] = $filter;
        return $this;
    }
    
    /**
     * @return MySQL\AbstractExpression
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
     * @param string|Argument\Column $column
     * @return Argument\Column
     */
    private function _parseColumn($column) {
        if ($column instanceof Argument\Column) {
            return $column;
        } elseif (is_string($column)) {
            return new Argument\Column($column);
        }
    }
    
    /**
     * @param mixed|MySQL\ObjectInterface $value
     * @return MySQL\ObjectInterface|Argument\Value
     */
    private function _parseValue($value) {
        if ($value instanceof MySQL\ObjectInterface) {
            return $value;
        } else {
            return new Argument\Value($value);
        }
    }
    
    /**
     * @param array $values
     * @return MySQL\ObjectInterface[]
     */
    private function _parseValues(array $values) {
        $result = [];
        foreach ($values as $value) {
            $result[] = $this->_parseValue($value);
        }
        return $result;
    }
    
}
