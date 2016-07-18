<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Builder;

use RsORM\Query\Engine\MySQL;

interface BuilderInterface {
    
    /**
     * @return MySQL\AbstractExpression
     */
    public function build();
}
