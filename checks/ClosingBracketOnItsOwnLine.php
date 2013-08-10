<?php

class Checks_ClosingBracketOnItsOwnLine
{
	public function check($line)
	{
		$line	=	trim($line);

		if(strpos($line, '}') !== false && strlen($line) !== 1)
			return 'Closing bracket must be on its own line';
	}
}