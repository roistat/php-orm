<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Clause;

use RsORM\Query\Engine\MySQL;

class Order extends AbstractClause {
    
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
        return "ORDER BY " . implode(", ", $this->_prepareArguments());
    }
    
}
