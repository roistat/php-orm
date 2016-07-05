<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Func;

use RsORM\Query\Engine\MySQL;

abstract class AbstractDistinctFunction extends AbstractFunction {
    
    /**
     * @var boolean
     */
    private $_isDistinct;
    
    /**
     * @param MySQL\ObjectInterface $expression
     * @param boolean $isDistinct
     */
    public function __construct(MySQL\ObjectInterface $expression, $isDistinct = false) {
        parent::__construct([$expression]);
        $this->_isDistinct = (bool) $isDistinct;
    }
    
    /**
     * @return string
     */
    protected function _prefix() {
        return $this->_isDistinct ? "DISTINCT " : "";
    }
    
}
