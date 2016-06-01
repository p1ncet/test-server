<?php

namespace TServer;

$path = "/..";
while (is_dir(__DIR__ . $path) && !is_dir(__DIR__ . "$path/vendor") && strlen($path) < 20) {
	$path .= "/..";
}
if (file_exists(__DIR__ . "$path/vendor/autoload.php")) {
	require_once __DIR__ . "$path/vendor/autoload.php";
} else {
	throw new \LogicException("Vendor dir not found");
}

if (isset($_ENV['handler']) && class_implements($_ENV['handler'], Responsible::class)) {
	/** @var Responsible $handler */
	$handler = new $_ENV['handler']();
	echo $handler->response();
} else {
	throw new \LogicException("Response handler is not specified or invalid");
}