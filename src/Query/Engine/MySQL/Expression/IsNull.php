<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Expression;

class IsNull extends Is {
    
    /**
     * @param ObjectInterface $operand
     */
    public function __construct(ObjectInterface $operand) {
        parent::__construct($operand, new NullValue());
    }
    
}
