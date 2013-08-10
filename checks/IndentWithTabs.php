<?php

class Checks_IndentWithTabs
{
	public static function check($line)
	{
		if(preg_match('#^(\t?[ ]+)#', $line))
			return 'Tab must be used to indent lines; spaces are not allowed';
	}
}