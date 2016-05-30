<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Filter;

class Gt extends AbstractComparativeFilter {

    protected function _operator() {
        return ">";
    }

}
