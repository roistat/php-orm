<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Flag;

class SQLBufferResult extends AbstractFlag {
    
    /**
     * @return string
     */
    public function prepare() {
        return "SQL_BUFFER_RESULT";
    }
}
