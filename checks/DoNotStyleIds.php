<?php

class Checks_DoNotStyleIds
{
	public function check($line)
	{
		if(preg_match('@^\s?#(.*){@', $line))
			return 'Id’s should not be styled';
	}
}