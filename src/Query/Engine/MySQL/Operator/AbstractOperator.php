<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operator;

use RSDB\Query\Engine\MySQL\Operand;

abstract class AbstractOperator {
    
    /**
     * @var Operand\AbstractOperand[]|AbstractOperator[]
     */
    protected $_operands = [];
    
    /**
     * @var array
     */
    protected $_values = [];
    
    /**
     * @param Operand\AbstractOperand[]|AbstractOperator[] $operands
     */
    public function __construct(array $operands) {
        foreach ($operands as $operand) {
            if ($operand instanceof Operand\AbstractOperand || $operand instanceof AbstractOperator) {
                $this->_operands[] = $operand;
            } else {
                throw new \Exception(); // todo
            }
        }
    }
    
    /**
     * @return string
     */
    public function prepare() {
        $result = "";
        foreach ($this->_operands as $operand) {
            if ($result) {
                $result .= " {$this->_operator()} ";
            }
            $result .= $operand->prepare();
        }
        if (count($this->_operands) === 1) {
            return "{$this->_operator()} {$result}";
        }
        return $result;
    }
    
    /**
     * @return string
     */
    abstract protected function _operator();
    
    /**
     * @return int
     */
    abstract protected function _precedence(); // todo?
    
    /**
     * @return array
     */
    public function values() {} // todo
    
}
