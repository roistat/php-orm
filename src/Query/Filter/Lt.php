<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Filter;

class Lt extends AbstractComparativeFilter {

    protected function _operator() {
        return "<";
    }

}
