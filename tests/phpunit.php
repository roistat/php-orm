<?php

/**
 * @author Evgeniy Udodov <flr.null@gmail.com>
 */


/**
 * Autoload fot Test namespace.
 *
 * @param string $className
 */
function testAutoLoad($className) {
    $path = str_replace('\\', '/', $className);
    if (strpos($className, 'RSDBTest') === 0) {
        $relativePath = 'tests'. preg_replace('~^RSDBTest/~', '/', $path) . '.php';
        require_once __DIR__ . "/../" . $relativePath;
    }
    if (strpos($className, 'RSDB') === 0) {
        $relativePath = 'src'. preg_replace('~^RSDB/~', '/', $path) . '.php';
        require_once __DIR__ . "/../" . $relativePath;
    }
}

spl_autoload_register('testAutoLoad');
