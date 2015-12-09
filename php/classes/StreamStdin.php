<?php
/**
 * reads stream from stdin
 *
 * Class StreamStdin
 */
class StreamStdin implements StreamInterface {

	private $stdin;
	private $lastCharRead = '';

	public function initStream() {
		if (!isset($this->stdin)) {
			$this->stdin = fopen('php://stdin', 'r');
		}
	}

	public function getChar() {
		$this->initStream();

		$this->lastCharRead = fgetc($this->stdin);
		return $this->lastCharRead;
	}

	public function streamEnded() {
		if ($this->lastCharRead === false) {
			return true;
		}

		return false;
	}
}