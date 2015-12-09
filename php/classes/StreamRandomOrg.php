<?php
/**
 * provides a stream of values from random.org
 *
 * Class StreamRandomOrg
 */
class StreamRandomOrg implements StreamInterface {

	private $srcUrl = 'https://www.random.org/sequences/?min=1&max=1000&col=1&format=plain&rnd=new';
	private $stream;
	private $index = -1;

	private function initStream() {
		if (!isset($this->stream)) {
			$this->stream = file_get_contents($this->srcUrl);
			if (false === $this->stream) {
				throw new Exception('Error reading the remote url ' . $this->srcUrl);
			}
			$this->stream = explode("\n",$this->stream);
			$this->index = 0;
		}
	}

	public function getChar() {
		$this->initStream();

		if ($this->streamEnded()) {
			return false;
		}

		$char = $this->stream[$this->index];
		$this->index++;
		return $char;
	}

	public function streamEnded() {

		return ($this->index >= count($this->stream));
	}
}