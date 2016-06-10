<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Expression;

class Equal extends AbstractBinaryOperator {
    
    /**
     * @return string
     */
    protected function _operator() {
        return "=";
    }
    
}
