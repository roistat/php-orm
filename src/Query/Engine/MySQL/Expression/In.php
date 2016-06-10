<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Expression;

class In extends AbstractCustomOperator {
    
    /**
     * @param ObjectInterface $operand
     * @param ObjectInterface[] $operands
     */
    public function __construct(ObjectInterface $operand, array $operands) {
        array_unshift($operands, $operand);
        parent::__construct($operands);
    }
    
    /**
     * @return string
     */
    public function prepare() {
        $preparedOperands = $this->_prepareOperands();
        $operand = array_shift($preparedOperands);
        $operands = implode(", ", $preparedOperands);
        return "{$operand} IN ({$operands})";
    }
    
}
