<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Expression;

abstract class AbstractOperand implements ObjectInterface {
    
    /**
     * @return bool|int|float|string
     */
    abstract public function value();
    
}
