<?php

namespace Testo;

class Server {
	
	private $server;
	private $pipes;
	private $host;
	private $port;

	/**
	 * Server constructor.
	 * @param string $handler
	 * @param string $host
	 * @param int $port
	 * @throws \Exception
	 */
	public function __construct($handler, $host = "127.0.0.1", $port = 12345) {
		if (!class_exists($handler) || !class_implements($handler, Responsible::class)) {
			throw new \LogicException("Class $handler doesn't exists or doesn't implement Responsible interface");
		}
		$this->host = $host;
		$this->port = $port;
		$cmd = "php -S $host:$port " . realpath(__DIR__ . "/response.php");
		$this->server = proc_open($cmd, [1 => ["pipe", "w"]], $this->pipes, __DIR__, ['handler' => $handler]);

		$r = false;
		$max_iteration = 50;
		while (--$max_iteration > 0) {
			usleep(20000);
			try {
				$r = @file_get_contents($this->getUrl());
				if ($r) {
					break;
				}
			} catch (\Exception $e) {
				// Server doesn't start yet
			}
		}
		if ($max_iteration === 0 && $r === false) {
			$this->__destruct();
			throw new \RuntimeException("Couldn't start server: $cmd");
		}
	}

	public function __destruct() {
		foreach ($this->pipes as $pipe) {
			fclose($pipe);
		}
		proc_terminate($this->server, SIGTERM);
		proc_close($this->server);
	}

	/**
	 * @return string
	 */
	public function getUrl() {
		return "http://{$this->host}:{$this->port}";
	}
}