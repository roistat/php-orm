<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Func;

class Concat extends AbstractFunction {
    
    /**
     * @return string
     */
    protected function _function() {
        return "CONCAT";
    }
    
}
