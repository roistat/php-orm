<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query;

use RsORM\Query\Builder;
use RsORM\Query\Engine\MySQL;
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
    public static function desc($name) {
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
    
    /**
     * @param string $columnName
     * @param string $aliasName
     * @param boolean $distinct
     * @return Argument\Field
     */
    public static function funcAvg($columnName, $aliasName, $distinct = false) {
        $column = new Argument\Column($columnName);
        $func = new Func\Avg($column, $distinct);
        $alias = new Argument\Alias($aliasName);
        return new Argument\Field($func, $alias);
    }
    
    /**
     * @param string $columnName
     * @param string $aliasName
     * @param boolean $distinct
     * @return Argument\Field
     */
    public static function funcSum($columnName, $aliasName, $distinct = false) {
        $column = new Argument\Column($columnName);
        $func = new Func\Sum($column, $distinct);
        $alias = new Argument\Alias($aliasName);
        return new Argument\Field($func, $alias);
    }
    
    /**
     * @param string[] $arguments
     * @param string $aliasName
     * @return Argument\Field
     */
    public static function funcConcat(array $arguments, $aliasName) {
        $parsedArguments = self::_parseArguments($arguments);
        $func = new Func\Concat($parsedArguments);
        $alias = new Argument\Alias($aliasName);
        return new Argument\Field($func, $alias);
    }
    
    /**
     * @param array $arguments
     * @return Argument\Value
     */
    private static function _parseArguments(array $arguments) {
        $result = [];
        foreach ($arguments as $argument) {
            if ($argument instanceof Engine\MySQL\ObjectInterface) {
                $result[] = $argument;
            } else {
                $result[] = new Argument\Value($argument);
            }
        }
        return $result;
    }
}
