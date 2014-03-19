<?php
include "vendor/autoload.php";

use SampleVendor\Interview\Router;

/**
 * Integration tests for Router class
 */
class RouterTest extends PHPUnit_Framework_TestCase
{
	public function testRouteNotFound()
	{
		$this->setExpectedException('SampleVendor\Interview\Exception\InterviewException');

		$router = new Router;

		$router->dispatch('/');
	}

	public function testAddedRoute()
	{
		$router = new Router;
		$router->add('/', function() {
			return "such hello!";
		});

		$this->assertEquals($router->dispatch('/'), 'such hello!');
	}

	public function testRouteWithParams()
	{
		$router = new Router;

		$router->add('/very', function($params) {
			return isset($params[0]) ? $params[0] : NULL;
		});

		$this->assertEquals($router->dispatch('/very/test'), 'test');
	}
}
