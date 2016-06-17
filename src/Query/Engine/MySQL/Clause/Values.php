<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Clause;

use RsORM\Query\Engine\MySQL;

class Values extends AbstractClause {
    
    /**
     * @param MySQL\ObjectInterface[] $values
     */
    public function __construct(array $values) {
        parent::__construct($values);
    }
    
    /**
     * @return string
     */
    public function prepare() {
        return "(" . implode(", ", $this->_prepareArguments()) . ")";
    }
    
}
