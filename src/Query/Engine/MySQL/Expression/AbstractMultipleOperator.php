<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Expression;

abstract class AbstractMultipleOperator extends AbstractSimpleOperator {
    
    /**
     * @return string
     */
    public function prepare() {
        return implode(" {$this->_prepareOperator()} ", $this->_prepareOperands());
    }
    
}
