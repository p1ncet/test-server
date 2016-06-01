<?php

namespace TServer;

require_once __DIR__ . "/../vendor/autoload.php";

if (isset($_ENV['handler']) && class_implements($_ENV['handler'], Responsible::class)) {
	/** @var Responsible $handler */
	$handler = new $_ENV['handler']();
	echo $handler->response();
} else {
	throw new \LogicException("Response handler is not specified or invalid");
}