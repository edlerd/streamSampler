<?php
class HttpStreamRefiller implements RefillerInterface {

	public function __construct ($url) {
		$this->srcUrl = $url;
	}

	public function read() {

		$contents = file_get_contents($this->srcUrl);
		if (false === $contents) {
			throw new Exception('Error reading the remote url ' . $this->srcUrl);
		}
		
		$contents = explode("\n",$this->stream);
		$result = new StreamResult($contents);
		return $result;
	}
}
