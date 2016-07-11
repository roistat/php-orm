<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query;

use RsORM\Query\Builder;
use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Engine\MySQL\Func;

class Builder {
    
    /**
     * @param string[] $objects
     * @return Builder\Select
     */
    public static function select(array $objects = null) {
        return new Builder\Select($objects);
    }
    
    /**
     * @return Builder\Filter
     */
    public static function filter() {
        return new Builder\Filter();
    }
    
    /**
     * @param string $name
     * @return Argument\Desc
     */
    public static function Desc($name) {
        $column = new Argument\Column($name);
        return new Argument\Desc($column);
    }
    
    /**
     * @param string $columnName
     * @param string $aliasName
     * @param boolean $distinct
     * @return Argument\Field
     */
    public static function funcCount($columnName, $aliasName, $distinct = false) {
        $column = new Argument\Column($columnName);
        $func = new Func\Count($column, $distinct);
        $alias = new Argument\Alias($aliasName);
        return new Argument\Field($func, $alias);
    }
}
