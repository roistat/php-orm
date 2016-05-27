<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Filter;

class IsNotNull extends AbstractUnaryFilter {

    protected function _operator() {
        return " IS NOT NULL";
    }

    protected function _isPrefix() {
        return false;
    }

}
