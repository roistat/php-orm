<?php
/**
 * Created by PhpStorm.
 * User: Юрий
 * Date: 03.07.2016
 * Time: 14:27
 */

namespace RsORM\Query\Engine\MySQL\Statement;

class Builder {
    /**
     * @var Builder
     */
    private static $_instance;
    
    private function __construct() {}

    /**
     * @return Builder
     */
    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new Builder();
        }
        return self::$_instance;
    }

    /**
     * If $fields is empty array - load all fields from table (*)
     * @param string[] $fields
     * @return Builder\Select
     */
    public function select(array $fields = []) {
        return new Builder\Select($fields);
    }
}