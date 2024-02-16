<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Clause;

use RsORM\Query\Engine\MySQL\Argument;

class Returning extends AbstractClause {

    /**
     * @param Argument\Column $column
     */
    public function __construct(Argument\Column $column) {
        parent::__construct([$column]);
    }

    /**
     * @return string
     */
    public function prepare() {
        return "RETURNING " . $this->_prepareArguments()[0];
    }
    
}
