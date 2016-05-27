<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Filter;

class Gt extends AbstractBinaryFilter {

    protected function _operator() {
        return " > ";
    }

}
