<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Filter;

class In extends AbstractBinaryFilter {
    
    protected function _operator() {
        return " IN ";
    }
    
}
