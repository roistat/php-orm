<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operand;

class Simple extends AbstractOperand {
    public function __construct($operand) {
        parent::__construct([$operand]);
    }
    public function prepare() {
        return "?";
    }
}
