<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Clause;

use RsORM\Query\Engine\MySQL;

class Order extends AbstractClause {
    
    /**
     * @return string
     */
    public function prepare() {
        return "ORDER BY " . implode(", ", $this->_prepareArguments());
    }
    
}
