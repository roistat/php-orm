<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM;

trait TraitClassHelper {
    
    /**
     * @return string
     */
    public static function getClassName() {
        return get_called_class();
    }
}
