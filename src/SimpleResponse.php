<?php

namespace TServer;

class SimpleResponse implements Responsible {

	/**
	 * @return string
	 */
	public function response() {
		$request = [
			"headers" => apache_request_headers(),
			"host"    => $_SERVER["HTTP_HOST"],
			"uri"     => $_SERVER["REQUEST_URI"],
			"get"     => $_GET,
			"post"    => $_POST,
		];
		return json_encode($request, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
	}
}
