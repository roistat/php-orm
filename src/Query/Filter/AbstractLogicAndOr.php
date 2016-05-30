<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Filter;

/**
 * Description of AbstractLogicAndOr
 *
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */
abstract class AbstractLogicAndOr extends AbstractLogic {
    
    /**
     * @param LogicInterface[] $operands
     */
    public function __construct(array $operands) {
        if (count($operands) < 2) {
            throw new Exception("Expect two or more operands");
        }
        $this->_operands = $operands;
        parent::__construct();
    }
    
}
