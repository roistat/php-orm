<?php
/**
 * @author Evgeniy Udodov <flr.null@gmail.com>
 */

namespace RsORMTest\State\Stub;

use RsORM;

class Entity extends RsORM\State\Entity {
    public $id;
    public $name;
    public $external_id;

    /**
     * @return string
     */
    public static function name() {
        return 'name';
    }

    /**
     * @return string
     */
    public static function id() {
        return 'id';
    }

    /**
     * @return string
     */
    public static function externalId() {
        return 'external_id';
    }
}
