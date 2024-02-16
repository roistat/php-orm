<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Builder;

use RsORM\Query\Engine\MySQL;
use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Engine\MySQL\Clause;

trait TraitInsertData {
    
    /**
     * @var Argument\Column[]
     */
    private array $_columns = [];
    
    /**
     * @var MySQL\ObjectInterface[]
     */
    private array $_values = [];

    protected function _setInsertData(array $data): void {
        foreach ($data as $field => $value) {
            $this->_setPair($field, $value);
        }
    }

    protected function _buildColumns(): ?Clause\Columns {
        return $this->_columns === [] ? null : new Clause\Columns($this->_columns);
    }

    protected function _buildValues(): ?Clause\Values {
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
            $this->_columns[] = $field;
        } elseif (is_string($field)) {
            $column = new Argument\Column($field);
            $this->_columns[] = new Argument\Field($column);
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
