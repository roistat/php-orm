<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Flag;

class HighPriority extends AbstractFlag {
    
    /**
     * @return string
     */
    public function prepare() {
        return "HIGH_PRIORITY";
    }
}
