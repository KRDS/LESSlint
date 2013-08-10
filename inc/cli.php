<?php

abstract class Cli
{
	protected static $_default_args	=	[
		'rules'		=> null,
		'paths'		=> [ ],
		'exclude'	=> [ ],
		'recursive' => false,
	];

	public static function parseArgs($args)
	{
		$ret	=	self::$_default_args;

		// Rules
		array_shift($args);
		$rules_path	=	array_shift($args);

		if( ! is_file($rules_path))
			throw new Exception('Rules files not found');

		$ret['rules']	=	json_decode(file_get_contents($rules_path), true);

		if( ! $ret['rules'] || ! is_array($ret['rules']))
			throw new Exception('Unable to read the rules file');

		// Files to check
		foreach($args as $arg)
		{
			if(preg_match('#^--([a-z]+)(?:=(.*))?#', $arg, $matches))
			{
				switch($matches[1])
				{
					case 'exclude':

						$ret['exclude']	=	explode(',', $matches[2]);

					break;

					case 'recursive':

						$ret['recursive']	=	true;

					break;

					default:
						throw new Exception('Unknown modifier “'.$matches[1].'”');
				}
			}
			else
			{
				if( ! file_exists($arg))
					throw new Exception('Path '.$arg.' does not exist');

				$ret['paths'][]	=	$arg;
			}
		}

		return $ret;
	}

	public static function showUsage()
	{
		echo <<<KRDS
LESSlint v0.1

Usage: lesslint rules.json /path/to/less/folder/ /path/to/file.less
    --exclude=file.less,lib.less
	--recursive

KRDS;
		
	}
}