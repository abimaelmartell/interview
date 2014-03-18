<?php
include "vendor/autoload.php";

$app = new SampleVendor\Interview\Router;

$callback1 = function($params) {
	echo "callback 1";
};

$callback2 = function($params) {
	echo "callback 2";
};

$app->add("/foo/bar", $callback2);
$app->add("/foo", $callback1);

$app->run();
