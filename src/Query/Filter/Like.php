<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Filter;

class Like extends AbstractBinaryFilter {
    
    protected function _operator() {
        return " LIKE ";
    }
    
}
