<?php
include "vendor/autoload.php";

$app = new SampleVendor\Interview\Router;

$callback1 = function($params) {

};

$callback2 = function($params) {

};

$app->add("/foo", $callback1);

$app->add("/foo/bar", $callback2);

$app->run();
