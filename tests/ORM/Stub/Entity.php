<?php
/**
 * @author Evgeniy Udodov <flr.null@gmail.com>
 */

namespace RSDBTest\ORM\Stub;

use RSDB;

class Entity extends RSDB\ORM\Entity {
    public $id;
    public $name;
    public $external_id;

    public static function filterByName($name) {
        return
    }
}
