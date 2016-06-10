<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Expression;

abstract class AbstractSimpleOperator extends AbstractOperator {
    
    /**
     * @return string
     */
    abstract protected function _operator();
    
    /**
     * @return string
     */
    protected function _prepareOperator() {
        return $this->_operator();
    }
    
}
