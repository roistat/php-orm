<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Expression;

interface ObjectInterface {
    
    /**
     * @return string
     */
    public function prepare();
    
}
