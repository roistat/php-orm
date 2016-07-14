<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Clause;

use RsORM;
use RsORM\Query\Engine\MySQL;

abstract class AbstractClause extends MySQL\AbstractExpression {
    use RsORM\TraitClassHelper;
}
