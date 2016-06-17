<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Clause;

use RsORM\Query\Engine\MySQL;
use RsORM\Query\Engine\MySQL\Condition;

class Set extends AbstractClause {
    
    /**
     * @param Condition\Equal[] $values
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
