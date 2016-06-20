<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Clause;

use RsORM\Query\Engine\MySQL\Argument;

class InsertFields extends Fields {
    
    /**
     * @return string
     */
    public function prepare() {
        return "(" . parent::prepare() . ")";
    }
    
}
