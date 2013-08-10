#!/usr/bin/php
<?php

require __DIR__.'/inc/bootstrap.php';

if($argc < 3)
{
	echo <<<KRDS
LESSlint v0.1

Usage: lesslint rules.json /path/to/less/folder/ /path/to/file.less
    --exclude=file.less,lib.less
	--recursive

KRDS;

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

$lint	=	new Lint($args['paths'], $args['rules'], $args['exclude'], $args['recursive']);
$lint->check();

exit($lint->hasErrors() ? 1 : 0);
