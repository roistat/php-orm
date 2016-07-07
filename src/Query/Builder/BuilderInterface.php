<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Builder;

use RsORM\Query\Engine\MySQL;

interface BuilderInterface {
    
    /**
     * @return MySQL\AbstractExpression
     */
    abstract public function build();
}
