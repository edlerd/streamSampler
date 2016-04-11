<?php
/**
 * provides a stream of values from random.org
 *
 * Class StreamRandomOrg
 */
class StreamResultReader implements StreamInterface {

	private $streamResult;
	private $index = -1;

	public __construct(StreamResult $streamResult) {
		$this->streamResult = $streamResult;
		$this->index = 0;
	}

	public function getChar() {
		
		if ($this->streamEnded()) {
			return false;
		}

		$char = $this->streamResult->getCharAt($this->index);
		$this->index++;
		return $char;
	}

	public function isStreamEnded() {

		return ($this->index >= $this->streamResult->getLength());
	}
}
