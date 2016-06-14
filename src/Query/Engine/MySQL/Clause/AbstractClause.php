<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Clause;

abstract class AbstractClause {
    
    /**
     * @return string
     */
    abstract public function prepare();
    
    /**
     * @return array
     */
    abstract public function values();
    
}
