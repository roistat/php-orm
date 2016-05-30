<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Filter;

abstract class AbstractLogic implements LogicInterface {
    
    /**
     * @var LogicInterface[]
     */
    protected $_operands = [];
    
    /**
     * @throws \Exception
     */
    public function __construct(){
        if (count($this->_operands) === 0) {
            throw new \Exception("No operands");
        }
    }
    
    /**
     * @return string
     */
    abstract protected function _operator();
    
    /**
     * @return string
     */
    public function prepare() {
        $result = "";
        foreach ($this->_operands as $operand) {
            if ($result) {
                $result .= " {$this->_operator()} ";
            }
            $result .= "({$operand->prepare()})";
        }
        if (count($this->_operands) === 1) {
            return "{$this->_operator ()} $result";
        }
        return $result;
    }
    
    /**
     * @return mixed[]
     */
    public function getParameters() {
        $result = [];
        foreach ($this->_operands as $operand) {
            $result = array_merge($result, $operand->getParameters());
        }
        return $result;
    }
    
}
