<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Expression;

interface ObjectInterface {
    
    /**
     * @return string
     */
    public function prepare();
    
}
