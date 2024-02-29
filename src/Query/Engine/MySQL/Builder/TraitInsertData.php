<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Builder;

use RsORM\Driver\Exception;
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

    protected function _setInsertDataMultiple(array $dataObjects): void {
        if (count($dataObjects) === 0) {
            return;
        }
        foreach ($dataObjects[0] as $field => $value) {
            $isCorrectField = $this->_setField($field);
            if (!$isCorrectField) {
                throw new Exception\PrepareStatementFail("Invalid field " . var_export($field, true));
            }
        }
        foreach ($dataObjects as $data) {
            $values = [];
            foreach ($data as $value) {
                $values[] = $this->_parseValue($value);
            }
            $this->_values[] = $values;
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
            $this->_values[] = $this->_parseValue($value);
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

    private function _parseValue($value): MySQL\ObjectInterface {
        if ($value instanceof MySQL\ObjectInterface) {
            return $value;
        } elseif ($value === null) {
            return new Argument\NullValue();
        } else {
            return new Argument\Value($value);
        }
    }
}
