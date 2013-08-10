#!/usr/bin/php
<?php

require __DIR__.'/cli.php';
require __DIR__.'/lint.php';
require __DIR__.'/file.php';

//Check the arguments
//-------------------------------------------------------------->
if($argc < 3)
{
	Cli::showUsage();
	exit;
}

try
{
	$args	=	Cli::parseArgs($argv);
}
catch(Exception $e)
{
	die('Error: '.$e->getMessage());
}

//Lint the files
//-------------------------------------------------------------->
spl_autoload_register(function($name)
{
	require __DIR__.'/../checks/'.substr($name, 7).'.php';
});

$lint	=	new Lint($args['paths'], $args['rules'], $args['exclude'], $args['recursive']);
$lint->check();

exit($lint->hasErrors() ? 1 : 0);
