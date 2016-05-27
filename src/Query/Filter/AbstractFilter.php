<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Filter;

abstract class AbstractFilter {
    
    /**
     * @var string[]|AbstractFilter[]
     */
    protected $_operands;
    
    /**
     * @param string[]|AbstractFilter[] $operands
     */
    public function __construct(array $operands) {
        if (count($operands) === 1 && is_string($operands[0])) {
            $operands[] = ":" . $operands[0];
        }
        $this->_operands = $operands;
    }
    
    /**
     * @return string
     */
    abstract public function prepare();
    
    /**
     * @param int $index
     * @return string
     */
    protected function _prepareOperand($index) {
        if (is_array($this->_operands[$index])) {
            return "(" . implode(", ", $this->_operands[$index]) . ")";
        }
        if ($this->_operands[$index] instanceof AbstractFilter) {
            return "(" . $this->_operands[$index]->prepare() . ")";
        }
        return $this->_operands[$index];
    }
    
    /**
     * @return string[]
     */
    protected function _prepareOperands() {
        $result = [];
        foreach ($this->_operands as $index => $operand) {
            $result[$index] = $this->_prepareOperand($index);
        }
        return $result;
    }
    
    /**
     * @return string
     */
    abstract protected function _operator();
    
}
