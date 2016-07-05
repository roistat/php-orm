<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Clause;

use RsORM\Query\Engine\MySQL\Flag;

class Flags extends AbstractClause {
    
    /**
     * @param Flag\AbstractFlag[] $arguments
     */
    public function __construct(array $flags) {
        parent::__construct($flags);
    }
    
    /**
     * @return string
     */
    public function prepare() {
        return implode(" ", $this->_prepareArguments());
    }
    
}
