<?php

defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(__FILE__)));

require_once APPLICATION_PATH . '/vendor/autoload.php';

$file =  APPLICATION_PATH . '/resources/jpg.JPG';
$oldSize = filesize($file);

$optimizer = new \Extlib\ImageOptimizer();
$optimizer->optimize($file);

$newSize = filesize($file);

\var_dump($oldSize);
\var_dump($newSize);
exit;
