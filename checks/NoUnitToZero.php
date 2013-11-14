<?php

class Checks_NoUnitToZero
{
	public function check($line)
	{
		if(preg_match('#[^0-9a-f\#]0([\%|in|cm|mm|em|ex|pt|pc|px|]+)#', $line))
			return 'No need to specify units when a value is 0';
	}
}