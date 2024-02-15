<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL;

use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Engine\MySQL\Func;

class Builder {
    
    /**
     * @param string[] $objects
     * @return Builder\Select
     */
    public static function select(array $objects = []) {
        return new Builder\Select($objects);
    }
    
    /**
     * @param array $data
     * @return Builder\Insert
     */
    public static function insert(array $data) {
        return new Builder\Insert($data);
    }
    
    /**
     * @param array $data
     * @return Builder\Update
     */
    public static function update(array $data) {
        return new Builder\Update($data);
    }
    
    /**
     * @return Builder\Delete
     */
    public static function delete() {
        return new Builder\Delete();
    }
    
    /**
     * @param array $data
     * @return Builder\Replace
     */
    public static function replace(array $data) {
        return new Builder\Replace($data);
    }
    
    /**
     * @return Builder\Filter
     */
    public static function filter() {
        return new Builder\Filter();
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
