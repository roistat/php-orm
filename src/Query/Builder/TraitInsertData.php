<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Builder;

use RsORM\Query\Engine\MySQL;
use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Engine\MySQL\Clause;

trait TraitInsertData {
    
    /**
     * @var Argument\Field[]
     */
    private $_fields = [];
    
    /**
     * @var MySQL\ObjectInterface[]
     */
    private $_values = [];
    
    /**
     * @param array $data
     */
    protected function _setInsertData(array $data) {
        foreach ($data as $field => $value) {
            $this->_setPair($field, $value);
        }
    }
    
    /**
     * @return Clause\Fields
     */
    protected function _buildFields() {
        return $this->_fields === [] ? null : new Clause\Fields($this->_fields);
    }
    
    /**
     * @return Clause\Values
     */
    protected function _buildValues() {
        return $this->_values === [] ? null : new Clause\Values($this->_values);
    }
    
    /**
     * @param string|Argument\Field $field
     * @param mixed|MySQL\ObjectInterface $value
     */
    private function _setPair($field, $value) {
        if ($this->_setField($field)) {
            $this->_setValue($value);
        }
    }
    
    /**
     * @param string|Argument\Field $field
     * @return boolean
     */
    private function _setField($field) {
        if ($field instanceof Argument\Field) {
            $this->_fields[] = $field;
        } elseif (is_string($field)) {
            $column = new Argument\Column($field);
            $this->_fields[] = new Argument\Field($column);
        } else {
            return false;
        }
        return true;
    }
    
    /**
     * @param mixed|MySQL\ObjectInterface $value
     */
    private function _setValue($value) {
        if ($value instanceof MySQL\ObjectInterface) {
            $this->_values[] = $value;
        } elseif ($value === null) {
            $this->_values[] = new Argument\NullValue();
        } else {
            $this->_values[] = new Argument\Value($value);
        }
    }
}
