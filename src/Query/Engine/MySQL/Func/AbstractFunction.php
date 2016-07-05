<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Func;

use RsORM\Query\Engine\MySQL;

abstract class AbstractFunction extends MySQL\AbstractExpression {
    
    /**
     * @return string
     */
    abstract protected function _function();
    
    /**
     * @return string
     */
    public function prepare() {
        $preparedArguments = implode(", ", $this->_prepareArguments());
        return "{$this->_function()}({$this->_prefix()}{$preparedArguments})";
    }
    
    /**
     * @return string
     */
    protected function _prefix() {
        return "";
    }
    
}
