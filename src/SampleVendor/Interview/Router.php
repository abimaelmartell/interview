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
	 * Base regex for paths (formatted for sprintf)
	 */
	const BASE_REGEX = "/%s(\/[\w]+|\/|$)/";

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
		$found = false;

		foreach ($this->callbacks as $path => $callback) {
			$regex = $this->buildRegex($path);

			if (preg_match($regex, $request) == 1) {
				$params = [];
				$callback($params);

				$found = true;
				break; /* stop looping through paths */
			}
		}

		if ($found == false) {
			throw new InterviewException("Error 404, route \"{$request}\" not found");
		}
	}

	/**
	 * Start dispatching requests
	 */
	public function run()
	{
		$path = $this->getRequestValue("REQUEST_URI");

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

	/**
	 * Build the regex for the given path
	 * @param string  $path
	 * @return string The regex
	 */
	private function buildRegex($path)
	{
		$safe_path = preg_quote($path, '/');
		$regex = sprintf(self::BASE_REGEX, $safe_path);

		return $regex;
	}
}
