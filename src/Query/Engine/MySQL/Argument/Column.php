<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Argument;

use RsORM\Query\Engine\MySQL;

class Column implements MySQL\SingleValueInterface {
    
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
        return "`{$this->_name}`";
    }
    
    public function value() {
        return null;
    }
    
}
