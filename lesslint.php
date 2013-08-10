#!/usr/bin/php
<?php

require __DIR__.'/inc/bootstrap.php';

if($argc < 3)
{
	echo <<<KRDS
LESSlint v0.1

Usage: lesslint rules.json /path/to/less/files
    --exclude=file.less,lib.less
	--recursive

KRDS;

	exit;
}

$exclude	=	[ ];

try
{
	// Rules
	if( ! is_file($argv[1]))
		throw new Exception('Rules files not found');

	$rules	=	json_decode(file_get_contents($argv[1]), true);

	if( ! $rules || ! is_array($rules))
		throw new Exception('Unable to read the rules file');

	// Files to check
	if( ! file_exists($argv[2]))
		throw new Exception('LESS folder not found');

	$path	=	$argv[2];

	// Modifiers
	if( ! empty($argv[3]))
	{
		if( ! preg_match('#--(.*)=(.*)#', $argv[3], $matches))
			throw new Exception('Wrong argument “'.$argv[3]);

		switch($matches[1])
		{
			case 'exclude':

				$exclude	=	explode(',', $matches[2]);

			break;

			default:
				throw new Exception('Unknown modifier “'.$matches[1].'”');
		}
	}
}
catch(Exception $e)
{
	die('Error: '.$e->getMessage());
}

$lint	=	new Lint($path, $rules, $exclude);
$lint->check();

