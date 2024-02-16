<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Builder;

use RsORM\Query\Engine\MySQL;
use RsORM\Query\Engine\MySQL\Clause;
use RsORM\Query\Engine\MySQL\Argument;

trait TraitReturning {

    protected ?Argument\Column $_column = null;

    public function returning(string $name): BuilderInterface {
        $this->_column = new Argument\Column($name);
        return $this;
    }

    protected function _buildReturning(): ?Clause\Returning {
        return $this->_column ? new Clause\Returning($this->_column) : null;
    }
}
