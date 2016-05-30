<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Filter;

class IsNotNull extends AbstractFilter {

    protected function _operator() {
        return "IS NOT NULL";
    }

}
