<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Argument;

class NullValue extends AbstractArgument {
    
    /**
     * @return string
     */
    public function prepare() {
        return "NULL";
    }
    
    public function value() {
        return null;
    }
    
}
