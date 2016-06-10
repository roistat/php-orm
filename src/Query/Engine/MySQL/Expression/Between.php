<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Expression;

class Between extends AbstractCustomOperator {
    
    /**
     * @param ObjectInterface $operand
     * @param ObjectInterface $min
     * @param ObjectInterface $max
     */
    public function __construct(ObjectInterface $operand, ObjectInterface $min, ObjectInterface $max) {
        parent::__construct([$operand, $min, $max]);
    }
    
    /**
     * @return string
     */
    public function prepare() {
        $preparedOperands = $this->_prepareOperands();
        return "{$preparedOperands[0]} BETWEEN {$preparedOperands[1]} AND {$preparedOperands[2]}";
    }
    
}
