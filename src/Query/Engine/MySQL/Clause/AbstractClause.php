<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Clause;

use RsORM\Query\Engine\MySQL;

abstract class AbstractClause implements MySQL\ExpressionInterface {
    
    /**
     * @return string
     */
    abstract public function prepare();
    
    /**
     * @return array
     */
    abstract public function values();
    
}
