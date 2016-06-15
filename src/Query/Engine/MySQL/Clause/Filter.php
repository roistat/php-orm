<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Clause;

use RsORM\Query\Engine\MySQL;

class Filter extends AbstractClause {
    
    /**
     * @param MySQL\ExpressionInterface $argument
     */
    public function __construct(MySQL\ExpressionInterface $argument) {
        parent::__construct([$argument]);
    }
    
    /**
     * @return string
     */
    public function prepare() {
        return "WHERE " . $this->_prepareArguments()[0];
    }
    
}
