<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL;

interface SingleValueInterface extends ExpressionInterface {
    
    /**
     * int|float|string
     */
    public function value();
    
}
