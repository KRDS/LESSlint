<?php

class Checks_OneSpaceBeforeBracket
{
	public static function check($line)
	{
		if(strpos($line, '{') !== false && ! preg_match('#[^ ] {1}{#', $line))
			return 'Use one space before an opening bracket: {';
	}
}