<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Clause;

use RsORM\Query\Engine\MySQL;

class Group extends AbstractClause {
    
    /**
     * @param MySQL\AbstractIdentifier[] $arguments
     */
    public function __construct(array $arguments) {
        parent::__construct($arguments);
    }
    
    /**
     * @return string
     */
    public function prepare() {
        return "GROUP BY " . implode(", ", $this->_prepareArguments());
    }
    
}
