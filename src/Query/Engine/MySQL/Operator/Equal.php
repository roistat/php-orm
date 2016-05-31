<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operator;

class Equal extends AbstractPairOperator {
    
    protected function _operator() {
        return "=";
    }
    
    protected function _precedence() {
        return 11;
    }
}
