<?php

class Checks_NotImportant
{
	public function check($line)
	{
		if(strpos($line, '!important'))
			return 'Avoid the use of !important';
	}
}