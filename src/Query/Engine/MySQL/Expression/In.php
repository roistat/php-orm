<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Expression;

class In extends AbstractCustomOperator {
    
    /**
     * @param ObjectInterface $operand
     * @param ObjectInterface[] $list
     */
    public function __construct(ObjectInterface $operand, array $list) {
        array_unshift($list, $operand);
        parent::__construct($list);
    }
    
    /**
     * @return string
     */
    public function prepare() {
        $preparedOperands = $this->_prepareOperands();
        $operand = array_shift($preparedOperands);
        $list = implode(", ", $preparedOperands);
        return "{$operand} IN ({$list})";
    }
    
}
