<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Flag;

class Distinct extends AbstractFlag {
    
    /**
     * @return string
     */
    public function prepare() {
        return "DISTINCT";
    }
    
}
