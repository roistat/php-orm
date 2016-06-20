<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Clause;

use RsORM\Query\Engine\MySQL\Operator;

class Set extends AbstractClause {
    
    /**
     * @param Operator\Assign[] $values
     */
    public function __construct(array $values) {
        parent::__construct($values);
    }
    
    /**
     * @return string
     */
    public function prepare() {
        return "SET " . implode(", ", $this->_prepareArguments());
    }
    
}
