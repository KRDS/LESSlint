<?php

class Checks_ColonSpacing
{
	public function check($line)
	{
		if(strpos($line, ':') !== false && strpos($line, '{') === false && ! preg_match('#([^\s]):([ ]{1})#', $line))
		{

			var_dump($line);
			return 'Colon should have no space before, and one after';
		}
	}
}