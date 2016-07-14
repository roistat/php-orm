<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Builder;

use RsORM\Query\Engine\MySQL;
use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Engine\MySQL\Clause;
use RsORM\Query\Engine\MySQL\Operator;

trait TraitUpdateData {
    
    /**
     * @var Operator\Assign[]
     */
    private $_assigns = [];
    
    /**
     * @param array $data
     */
    protected function _setUpdateData(array $data) {
        foreach ($data as $field => $value) {
            $this->_setAssign($field, $value);
        }
    }
    
    /**
     * @return Clause\Set
     */
    protected function _buildSet() {
        return $this->_assigns === [] ? null : new Clause\Set($this->_assigns);
    }
    
    /**
     * @param string|Argument\Field $field
     * @param mixed|MySQL\ObjectInterface $value
     */
    private function _setAssign($field, $value) {
        $fieldObject = $this->_parseField($field);
        $valueObject = $this->_parseValue($value);
        if ($fieldObject !== null && $valueObject !== null) {
            $this->_assigns[] = new Operator\Assign($fieldObject, $valueObject);
        }
    }
    
    /**
     * @param string|Argument\Field $field
     * @return Argument\Field
     */
    private function _parseField($field) {
        if ($field instanceof Argument\Field) {
            return $field;
        } elseif (is_string($field)) {
            $column = new Argument\Column($field);
            return new Argument\Field($column);
        } else {
            return null;
        }
    }
    
    /**
     * @param mixed|MySQL\ObjectInterface $value
     * @return MySQL\ObjectInterface
     */
    private function _parseValue($value) {
        if ($value instanceof MySQL\ObjectInterface) {
            return $value;
        } elseif ($value === null) {
            return new Argument\NullValue();
        } else {
            return new Argument\Value($value);
        }
    }
}
