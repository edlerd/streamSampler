<?php
/**
 * provides a stream of values from random.org
 *
 * Class StreamRandomOrg
 */
class StreamHandler implements StreamInterface {

	private $streamResult;
	private $index = -1;
	/**
	 * @var RefillerInterface
	 */
	private $refiller;

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

	public function streamEnded() {

		return ($this->index >= $this->streamResult->getLength());
	}
}
