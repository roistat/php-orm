<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Clause;

use RsORM\Query\Engine\MySQL\Argument;

class Fields extends AbstractClause {
    
    /**
     * @param Argument\Field[] $fields
     */
    public function __construct(array $fields) {
        parent::__construct($fields);
    }
    
    /**
     * @return string
     */
    public function prepare() {
        return "(" . implode(", ", $this->_prepareArguments()) . ")";
    }
    
}
