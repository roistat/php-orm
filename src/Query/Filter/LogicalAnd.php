<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Filter;

class LogicalAnd extends AbstractLogicAndOr {
    
    protected function _operator() {
        return "AND";
    }
    
}
