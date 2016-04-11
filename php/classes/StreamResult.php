<?

class StreamResult {

	private $streamCharacters;

	public function __construct($string) {
		$this->streamCharacters = $string
	}

	public function getLength() {
		return count($this->streamCharacters);
	}

	public function getCharAt($index) {
		return $this->streamCharacters[$index];
	}
	

}
