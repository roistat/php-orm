<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Statement;

use RsORM\Query\Engine\MySQL\Clause;

class Select {
    
    /**
     * @var array
     */
    private $_arguments = [];
    
    private $_fields = [];
    
    /**
     * @param array $fields
     * @param Clause\Table $table
     * @param Clause\Filter $filter
     */
    public function __construct(array $fields, Clause\Table $table = null, Clause\Filter $filter = null) {
        $this->_fields = $fields;
        $this->_arguments = [$table, $filter];
    }
    
    /**
     * @return string
     */
    public function prepare() {
        return "SELECT " . implode(", ", $this->_prepareFields()) . " " . implode(" ", $this->_prepareArguments());
    }
    
    /**
     * @return string[]
     */
    private function _prepareArguments() {
        $result = [];
        foreach ($this->_arguments as $argument) {
            $result[] = $argument->prepare();
        }
        return $result;
    }
    
    /**
     * @return string[]
     */
    private function _prepareFields() {
        $result = [];
        foreach ($this->_fields as $field) {
            $result[] = $field->prepare();
        }
        return $result;
    }
    
    
    /**
     * @return array
     */
    public function values() {
        $result = [];
        foreach ($this->_fields as $field) {
            if ($field->value() !== null) {
                $result[] = $field->value();
            }
        }
        foreach ($this->_arguments as $argument) {
            $result = array_merge($result, $argument->values());
        }
        return $result;
    }
    
}
