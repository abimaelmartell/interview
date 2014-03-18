<?php

namespace SampleVendor\Interview;

use SampleVendor\Interview\Exception\InterviewException;

class Router implements RouterInterface
{
	/**
	 * Array with path => callback
	 * @var array
	 */
	private $callbacks = [];

	/**
	 * Adds a path with its callback
	 * @param string   $path
	 * @param callable $callback
	 */
	public function add($path, callable $callback)
	{
		$this->callbacks[$path] = $callback;

		return $this;
	}

	/**
	 * Dispatches the request
	 *
	 * @param  string $request
	 */
	public function dispatch($request)
	{
		if (isset($this->callbacks[$request])) {
			$params = [];
			$this->callbacks[$request]($params);
		} else {
			throw new InterviewException("Error 404, route not found");
		}
	}

	/**
	 * Start dispatching requests
	 */
	public function run()
	{
		$path = $this->getRequestValue("PATH_INFO");

		$this->dispatch($path);
	}

	/**
	 * Get a $_SERVER value
	 * @param string $varname
	 * @return (string|NULL) The value or NULL if not found
	 */
	private function getRequestValue($varname)
	{
		return isset($_SERVER[$varname]) ? $_SERVER[$varname] : NULL;
	}
}
