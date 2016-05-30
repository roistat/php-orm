<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Filter;

class Equal extends AbstractComparativeFilter {
    
    protected function _operator() {
        return "=";
    }
    
}