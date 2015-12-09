<?php
/**
 * generates a stream of random uppercase characters
 *
 * Class StreamRandom
 */
class StreamRandom implements StreamInterface {

	private $streamLength = 1000;
	private $index = 0;

	public function __construct() {
		// seed mt_rand
		list($usec, $sec) = explode(' ', microtime());
		$seed = (float) $sec + ((float) $usec * 100000);
		mt_srand($seed);
	}

	public function getChar() {
		$this->index++;
		// mt_rand has some flaws, php7 provides random_int which has no known flaws (yet)
		// see also http://php.net/manual/en/function.mt-rand.php
		return chr(mt_rand(65,90));
	}

	public function streamEnded() {
		return ($this->index > $this->streamLength);
	}
}
