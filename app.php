<?php
include "vendor/autoload.php";

$app = new SampleVendor\Interview\Router;

$callback1 = function($params) {
	echo "callback 1 with params ". print_r($params, true);
};

$callback2 = function($params) {
	echo "callback 2 with params ". print_r($params, true);
};

$app->add("/foo/bar", $callback2);
$app->add("/foo", $callback1);

$app->run();
