<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Argument;

abstract class AbstractArgument {
    
    /**
     * @return string
     */
    public function prepare();
    
    /**
     * @return array
     */
    public function value();
    
}
