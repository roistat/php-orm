<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Clause;

/**
 * Description of Table
 *
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */
class Table {
    
    /**
     * @param string $name
     */
    public function __construct($name) {}
    
    /**
     * @return string
     */
    public function prepare() {}
    
    /**
     * @return array
     */
    public function values() {}
    
}
