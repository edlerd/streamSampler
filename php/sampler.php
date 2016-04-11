#!/usr/bin/php
<?php
/**
 * script to get a representative sample of given length from input streams.
 * supported stream formats are
 *  - stdin (read values from stdin)
 *  - random (genearte random stream of characters)
 *  - randomOrg (call random.org for random numbers as values)
 *
 * example usage:
 * echo "Hello World" | ./sampler.php --stream=stdin
 */
require_once(__DIR__ . '/config/bootstrap.php');

$shortopts  = "";
$longopts  = array(
	"stream::",
);
$options = getopt($shortopts, $longopts);

function print_usage_exit() {
	echo "missing or unsupported value for argument stream usage:\n";
	echo __FILE__ . " --stream=[stdin, random, randomOrg]\n";
	exit;
}

if (! isset($options["stream"])) {
	print_usage_exit();
}

switch ($options["stream"]) {
	case 'stdin':
		$stream = new StreamStdin();
		break;
	case 'random':
		$stream = new StreamRandom($length);
		break;
	case 'randomOrg':
		$url = '';
		$streamResult = new HttpStreamRandomOrgRefiller($url)->read();
		break;
	default:
		print_usage_exit();
}

$stream = new StreamHandler($streamResult);

$sampler = new Sampler();
$sampler->updateFrequencyArray($stream);
$sample = $sampler->produceSample(5);

echo "a sample from the input string is [$sample]\n";
