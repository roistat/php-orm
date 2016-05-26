<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'phpunit.php';
ini_set('display_startup_errors', 1);
ini_set('display_errors', "On"); // Off
error_reporting(E_ALL);

$f1 = new RSDB\Query\Filter\Equal("id");
$f2 = new RSDB\Query\Filter\Gt("id", ":qwe");
$f3 = new \RSDB\Query\Filter\Between("id", "id1", "id2");
$f4 = new \RSDB\Query\Filter\FilterAnd([$f1, $f2, $f3]);
$f5 = new \RSDB\Query\Filter\Not($f4);

var_dump($f1->prepare());
var_dump($f2->prepare());
var_dump($f3->prepare());
var_dump($f4->prepare());
var_dump($f5->prepare());