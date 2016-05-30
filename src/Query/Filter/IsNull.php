<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Filter;

class IsNull extends AbstractFilter {

    protected function _operator() {
        return "IS NULL";
    }

}
