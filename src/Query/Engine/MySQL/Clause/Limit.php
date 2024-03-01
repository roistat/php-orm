<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Clause;

use RsORM\Query\Engine\MySQL\Argument;

class Limit extends AbstractClause {

    public function __construct(?Argument\Value $count, ?Argument\Value $offset = null) {
        parent::__construct([$count, $offset]);
    }
    
    /**
     * @return string
     */
    public function prepare() {
        return "LIMIT " . implode(" OFFSET ", $this->_prepareArguments());
    }
    
}
