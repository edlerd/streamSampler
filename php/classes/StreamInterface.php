<?php

interface StreamInterface {
	/**
	 * @return string a single char from string
	 */
	public function getChar();

	/**
	 * @return bool the stream has no characters left
	 */
	public function streamEnded();
}