<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL;

interface MultiValueInterface extends ExpressionInterface {
    
    /**
     * array
     */
    public function values();
    
}
