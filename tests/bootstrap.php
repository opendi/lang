<?php
echo "Frontend PHPUnit Tests.".PHP_EOL;
echo "boostrapping testsuite".PHP_EOL;
echo "----------------------".PHP_EOL;

@ini_set("display_errors", "On");
@ini_set("display_startup_errors", "On");

require './vendor/autoload.php';

$loader = new \Composer\Autoload\ClassLoader();
$loader->add('Opendi', array('./src', './tests'));
$loader->register();
