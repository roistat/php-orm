<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Builder;

use RsORM\Query\Engine\MySQL;

abstract class AbstractBuilder {
    
    /**
     * @return MySQL\AbstractExpression
     */
    abstract public function build();
    
    /**
     * @param mixed $object
     * @param string $class
     * @return MySQL\AbstractExpression
     */
    protected function _buildClause($object, $class) {
        if ($object instanceof AbstractBuilder) {
            $object = $object->build();
        }
        if ($object === null || $object === []) {
            return null;
        }
        return new $class($object);
    }
}
