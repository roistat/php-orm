<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL;

use RsORM\Driver\Exception;

class AbstractIdentifier implements ObjectInterface {
    
    /**
     * @var string
     */
    private $_name;
    
    /**
     * @param string $name
     */
    public function __construct($name) {
        $this->_name = $name;
    }
    
    /**
     * @return string
     */
    public function prepare() {
        $regexp = '/^[a-zA-Z0-9_.*-]+$/';
        if (!preg_match($regexp, $this->_name)) {
            throw new Exception\PrepareStatementFail("Invalid identifier {$this->_name}");
        }
        return $this->_name;
    }
    
}
