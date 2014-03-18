<?php

namespace SampleVendor\Interview;

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
		$this->callbacks[$path] = $callbacks;

		return $this;
	}

	/**
	 * Dispatches the request
	 *
	 * @param  string $request
	 * @return mixed Output generated by the callback
	 */
	public function dispatch($request)
	{
		if (isset($this->callbacks[$request])) {
			$response = $this->callbacks[$request]();

			return $response;
		}
	}

	/**
	 * Start dispatching requests
	 */
	public function run()
	{
		// TODO
	}
}