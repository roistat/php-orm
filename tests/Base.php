<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 29/10/14
 * Time: 21:30
 */

namespace RSDBTest;

abstract class Base extends \PHPUnit_Framework_TestCase {

    /**
     * @param array $array1
     * @param array $array2
     */
    protected function _assertAssocArraysEquals(array $array1, array $array2) {
        $result = true;
        if (count($array1) !== count($array2)) {
            $result = false;
        }
        if ($result) {
            foreach ($array1 as $param => $value) {
                if (!array_key_exists($param, $array2)) {
                    $result = false;
                    break;
                }
                if ($value !== $array2[$param]) {
                    $result = false;
                    break;
                }
            }
        }
        if ($result) {
            foreach ($array2 as $param => $value) {
                if (!array_key_exists($param, $array1)) {
                    $result = false;
                    break;
                }
            }
        }
        $this->assertTrue($result, "Arrays are not equal: " . var_export($array1, true) . " != " . var_export($array2, true));
    }
}
