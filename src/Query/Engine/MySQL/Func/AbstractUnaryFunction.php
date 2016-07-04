<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Func;

use RsORM\Query\Engine\MySQL;

abstract class AbstractUnaryFunction extends AbstractFunction {
    
    /**
     * @param MySQL\ObjectInterface $argument
     */
    public function __construct(MySQL\ObjectInterface $argument) {
        parent::__construct([$argument]);
    }
    
}
