<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Filter;

interface LogicInterface {
    
    /**
     * @return string
     */
    public function prepare();
    
    /**
     * @return mixed[]
     */
    public function getParameters();
    
}
