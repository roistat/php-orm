<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Clause;

use RsORM\Query\Engine\MySQL;

class Filter extends AbstractClause {
    
    /**
     * @param MySQL\ObjectInterface $condition
     */
    public function __construct(MySQL\ObjectInterface $condition) {
        parent::__construct([$condition]);
    }
    
    /**
     * @return string
     */
    public function prepare() {
        return "WHERE " . $this->_prepareArguments()[0];
    }
    
}
