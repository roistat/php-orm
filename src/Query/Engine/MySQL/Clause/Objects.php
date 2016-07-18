<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Clause;

use RsORM\Query\Engine\MySQL;

class ArgumentsList extends MySQL\AbstractExpression {
    /**
     * @return string
     */
    public function prepare() {
        return implode(', ', $this->_prepareArguments());
    }
}
