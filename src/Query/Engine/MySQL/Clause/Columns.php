<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Clause;

use RsORM\Query\Engine\MySQL\Argument;

class Columns extends AbstractClause {
    
    /**
     * @param Argument\Column[] $columns
     */
    public function __construct(array $columns) {
        parent::__construct($columns);
    }
    
    /**
     * @return string
     */
    public function prepare() {
        return "(" . implode(", ", $this->_prepareArguments()) . ")";
    }
}
