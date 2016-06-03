<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operator;
use RSDB\Query\Engine\MySQL\Operand;

abstract class AbstractPairOperator extends AbstractOperator {
    
    /**
     * @param Operand\AbstractOperand|AbstractOperator $operand1
     * @param Operand\AbstractOperand|AbstractOperator $operand2
     */
    public function __construct($operand1, $operand2) {
        parent::__construct([$operand1, $operand2]);
    }
    
}
