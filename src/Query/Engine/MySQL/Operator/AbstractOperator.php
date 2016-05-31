<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operator;

use RSDB\Query\Engine\MySQL\Operand;

abstract class AbstractOperator {
    protected $_operands = [];
    protected $_values = [];
    public function __construct(array $operands) {
        foreach ($operands as $operand) {
            if ($operand instanceof Operand\AbstractOperand) {
                $this->_operands[] = $operand;
            } else {
                $this->_operands[] = new Operand\Simple($operand);
            }
        }
    }
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
    abstract protected function _operator();
    abstract protected function _precedence(); // ?
    public function values() {}
}
