<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Expression;

abstract class AbstractOperator implements ObjectInterface {
    
    /**
     * @var ObjectInterface[]
     */
    protected $_operands = [];
    
    /**
     * @param ObjectInterface[] $operands
     */
    public function __construct(array $operands) {
        $this->_operands = $operands;
    }
    
    /**
     * @return array
     */
    public function values() {
        $result = [];
        foreach ($this->_operands as $operand) {
            if ($operand instanceof self) {
                $result = array_merge($result, $operand->values());
            } elseif ($operand->value() !== null) {
                $result[] = $operand->value();
            }
        }
        return $result;
    }
    
    /**
     * @return string[]
     */
    protected function _prepareOperands() {
        $result = [];
        foreach ($this->_operands as $operand) {
            if ($operand instanceof self) {
                $result[] = "({$operand->prepare()})";
            } else {
                $result[] = $operand->prepare();
            }
        }
        return $result;
    }

}
