<?php

class Router
{
	private $request;

	public function __construct($request)
	{
		$this->request = $request;
	}
	public function get($route, $file)
	{
		$parameter_split = explode("?",$this->request);
		$uri = trim($parameter_split[0]);
		$uri = explode("/", $uri);
		if ($uri[2] == trim($route, "/")) {
			require $file . '.php';
		}
	}
}