<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query;

use RsORM\Query\Builder;

class Builder {
    
    /**
     * @param string[] $objects
     * @return Builder\Select
     */
    public static function select(array $objects = null) {
        return new Builder\Select($objects);
    }
    
    public static function filter() {
        return new Builder\Filter();
    }
}
