<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operator;

abstract class AbstractPairOperator extends AbstractOperator {
    public function __construct($operand1, $operand2) {
        parent::__construct([$operand1, $operand2]);
    }
}
