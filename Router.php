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
		$uri = trim($this->request);
		$uri = explode("/", $uri);
		if($uri[2] == trim($route, "/")) {

			require $file . '.php';
		}
	}
}