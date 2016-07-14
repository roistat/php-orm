<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Clause;

use RsORM\Query\Engine\MySQL\Argument;

class Limit extends AbstractClause {
    
    /**
     * @param Argument\Value $offset
     * @param Argument\Value $count
     */
    public function __construct(Argument\Value $offset, Argument\Value $count = null) {
        parent::__construct([$offset, $count]);
    }
    
    /**
     * @return string
     */
    public function prepare() {
        return "LIMIT " . implode(", ", $this->_prepareArguments());
    }
    
}
