<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operator;

use RSDB\Query\Engine\MySQL\Operand;

abstract class AbstractOperator extends Operand\AbstractOperand {
    
    /**
     * @var Operand\AbstractOperand[]
     */
    protected $_values = [];
        
    /**
     * @param Operand\AbstractOperand[] $operands
     */
    public function __construct(array $operands) {
        foreach ($operands as $operand) {
            if (!$operand instanceof Operand\AbstractOperand) {
                throw new \Exception(); // todo
            }
        }
        parent::__construct($operands);
    }
    
    /**
     * @param Operand\AbstractOperand $operand
     * @return string
     */
    protected function _prepareOperand(Operand\AbstractOperand $operand) {
        if ($operand instanceof AbstractOperator) {
            return "({$operand->prepare()})";
        } else {
            return $operand->prepare();
        }
    }
    
    /**
     * @return string
     */
    abstract protected function _operator();
        
    /**
     * @return array
     */
    public function values() {
        $result = [];
        foreach ($this->_values as $operand) {
            $result = array_merge($result, $operand->values());
        }
        return $result;
    }
    
}
