<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Flag;

class Delayed extends AbstractFlag {
    
    /**
     * @return string
     */
    public function prepare() {
        return "DELAYED";
    }
}
