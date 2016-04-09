<?php
/**
 * @author Evgeniy Udodov <flr.null@gmail.com>
 */

namespace RSDB\Query;

class Engine {

    /**
     * @var Engine\MySQL
     */
    private static $_mysqlInstance;

    /**
     * @return Engine\MySQL
     */
    public static function mysql() {
        if (self::$_mysqlInstance === null) {
            self::$_mysqlInstance = new Engine\MySQL();
        }
        return self::$_mysqlInstance;
    }
}
