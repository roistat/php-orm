<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Filter;

class Not extends AbstractUnaryFilter {
    
    protected function _operator() {
        return "NOT ";
    }
    
}
