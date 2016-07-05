<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Flag;

class SQLCalcFoundRows extends AbstractFlag {
    
    /**
     * @return string
     */
    public function prepare() {
        return "SQL_CALC_FOUND_ROWS";
    }
}
