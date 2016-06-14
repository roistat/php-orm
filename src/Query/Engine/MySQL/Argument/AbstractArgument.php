<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Argument;

use RsORM\Query\Engine\MySQL;

abstract class AbstractArgument implements MySQL\ExpressionInterface {
    
    /**
     * @return string
     */
    public function prepare();
    
    /**
     * @return int|float|string
     */
    public function value();
    
}
