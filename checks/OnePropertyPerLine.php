<?php

class Checks_OnePropertyPerLine
{
	public static function check($line)
	{
		if($line && substr_count($line, ';') > 1)
			return 'One property per line max';
	}
}