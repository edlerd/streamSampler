<?php
require_once __DIR__ . '/../config/bootstrap.php';

/**
 * test class that tests... the tests
 */
class SamplerTest extends \PHPUnit_Framework_TestCase {

	public function testCountStream() {

		$stream = new StreamDummy();
		$counter = new Sampler();
		$counter->updateFrequencyArray($stream);
		$sample = $counter->produceSample(5);
		$values = explode(' ', $sample);

		$this->assertEquals(6, count($values));
	}

	public function testCountRandomOrg() {
		$stream = new StreamRandomOrg();
		$counter = new Sampler();
		$counter->updateFrequencyArray($stream);
		$sample = $counter->produceSample(5, ' ');

		$values = explode(' ', $sample);

		$this->assertEquals(6, count($values));
	}

	public function testRandomGenerator() {
		$stream = new StreamRandom();
		$counter = new Sampler();
		$counter->updateFrequencyArray($stream);
		$sample = $counter->produceSample(5, ' ');

		$values = explode(' ', $sample);

		$this->assertEquals(6, count($values));
	}

}
