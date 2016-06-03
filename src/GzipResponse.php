<?php

namespace Testo;

class GzipResponse extends EchoResponse {
	public function response() {
		header("Content-Encoding: gzip");
//		$content = gzcompress(parent::response());
//		$content = gzinflate(parent::response());
		$content = gzencode(parent::response());
//		header("Content-Length: " . mb_strlen($content));
		return $content;
	}
}
