<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Chain;

use RsORM\Query\Engine\MySQL;
use RsORM\Query\Engine\MySQL\Clause;
use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Engine\MySQL\Statement;

class Select implements MySQL\MultiValueInterface {
    
    /**
     * @var Statement\Select
     */
    private $_instance;
    
    /**
     * @var Clause\Fields
     */
    private $_fields;
    
    /**
     * @var Clause\From;
     */
    private $_table;
    
    /**
     * @param string[] $fields
     */
    public function __construct(array $fields) {
        $fieldSet = [];
        foreach ($fields as $field) {
            $fieldSet[] = new Argument\Field(new Argument\Column($field));
        }
        $this->_fields = new Clause\Fields($fieldSet);
    }
    
    /**
     * @return Statement\Select
     */
    private function getInstance() {
        if ($this->_instance === null) {
            $this->_instance = new Statement\Select($this->_fields, $this->_table);
        }
        return $this->_instance;
    }
    
    /**
     * @return string
     */
    public function prepare() {
        return $this->getInstance()->prepare();
    }
    
    /**
     * @return array
     */
    public function values() {
        return $this->getInstance()->values();
    }
    
}
