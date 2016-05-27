<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Filter;

class IsNull extends AbstractUnaryFilter {

    protected function _operator() {
        return " IS NULL";
    }

    protected function _isPrefix() {
        return false;
    }

}
