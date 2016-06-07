<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operator;

abstract class AbstractOperator {
    
    /**
     * @return string
     */
    abstract public function prepare();
    
    /**
     * @return string
     */
    abstract public function values();
    
}
