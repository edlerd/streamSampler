<?php
/**
 * would be nice to have an autoloader, but for the sake of this simple project
 * this hacky way does the job
 */
require_once(__DIR__ . '/../classes/Sampler.php');
require_once(__DIR__ . '/../classes/StreamInterface.php');
require_once(__DIR__ . '/../classes/StreamStdin.php');
require_once(__DIR__ . '/../classes/StreamRandomOrg.php');
require_once(__DIR__ . '/../classes/StreamRandom.php');