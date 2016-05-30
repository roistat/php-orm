<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Filter;

class LogicalOr extends AbstractLogicAndOr {
    
    protected function _operator() {
        return "OR";
    }
    
}
