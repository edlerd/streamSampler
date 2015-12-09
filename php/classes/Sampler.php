<?php

/**
 * Class Sampler
 *
 * to get representative samples from streamed input
 */
class Sampler {
	private $frequency;
	private $frequencyTotal = 0;

	/**
	 * counts frequency of all values from input stream in a private variable
	 *
	 * @param StreamInterface $input
	 * @throws Exception
	 */
	public function updateFrequencyArray(StreamInterface $input) {

		while (! $input->streamEnded()) {

			$char = $input->getChar();

			if ($char === false) {
				break;
			}

			if (PHP_INT_MAX == $this->frequencyTotal) {
				throw new Exception('the counts in the frequency array are about to exceed ' . PHP_INT_MAX);
			}

			$this->frequencyTotal++;

			if (isset($this->frequency[$char])) {
				$this->frequency[$char]++;
			} else {
				$this->frequency[$char] = 1;
			}

		}
	}

	/**
	 * produce sample according to registered frequency of values
	 *
	 * @param int $length desired sample length
	 * @param string $separator a semparator between characters in the output stream
	 * @return string
	 * @throws Exception
	 */
	public function produceSample($length, $separator = ' ') {

		if (!isset($this->frequency)) {
			throw new Exception('the frequency array was not yet initialised, call updateFrequencyArray first');
		}
		
		if ($length > $this->frequencyTotal) {
			throw new Exception('cannot produce a sampel bigger than given input stream');
		}

		$sample = '';

		for ($i=0; $i<$length; $i++) {
			$diceRoll = rand(0,$this->frequencyTotal);

			$runner = 0;
			foreach($this->frequency as $value => $count) {
				$runner += $count;
				if ($runner >= $diceRoll) {
					$this->frequency[$value]--;
					if ($this->frequency[$value] == 0) {
						unset ($this->frequency[$value]);
					}
					$this->frequencyTotal--;
					$sample .= $value . $separator;
					break;
				}
			}
		}

		return $sample;
	}
}
