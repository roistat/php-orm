<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Clause;

class Order extends AbstractClause {
    
    /**
     * @return string
     */
    public function prepare() {
        return "ORDER BY " . implode(", ", $this->_prepareArguments());
    }
    
}
