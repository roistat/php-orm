<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Clause;

class Fields extends AbstractClause {
    
    /**
     * @var Field
     */
    private $_fields = [];
    
    /**
     * @param Field[] $fields
     */
    public function __construct(array $fields) {
        $this->_fields = $fields;
    }
    
    /**
     * @return string
     */
    public function prepare() {
        return implode(", ", $this->_prepareFields());
    }
    
    /**
     * @return array
     */
    public function values() {
        $result = [];
        foreach ($this->_fields as $field) {
            $result = array_merge($result, $field->values());
        }
        return $result;
    }
    
    /**
     * @return string[]
     */
    protected function _prepareFields() {
        $result = [];
        foreach ($this->_fields as $field) {
            $result[] = $field->prepare();
        }
        return $result;
    }
    
}
