<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operator;

abstract class AbstractOperand {
    
    /**
     * @return string
     */
    abstract public function prepare();
    
    /**
     * @return string
     */
    abstract public function values();
    
}
