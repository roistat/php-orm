<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Argument;

use RsORM\Query\Engine\MySQL;

class Desc implements MySQL\ObjectInterface {
    
    /**
     * @var MySQL\AbstractIdentifier
     */
    private $_identifier;
    
    /**
     * @param MySQL\AbstractIdentifier $identifier
     */
    public function __construct(MySQL\AbstractIdentifier $identifier) {
        $this->_identifier = $identifier;
    }
    
    /**
     * @return string
     */
    public function prepare() {
        return $this->_identifier->prepare() . " DESC";
    }
    
}
