<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Filter;

class LogicalNot extends AbstractLogic {
    
    /**
     * @param LogicInterface $operand
     */
    public function __construct(LogicInterface $operand) {
        $this->_operands = [$operand];
        parent::__construct();
    }
    
    protected function _operator() {
        return "NOT";
    }
    
}
