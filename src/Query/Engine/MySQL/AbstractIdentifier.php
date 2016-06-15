<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL;

class AbstractIdentifier implements ExpressionInterface {
    
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
    
}
