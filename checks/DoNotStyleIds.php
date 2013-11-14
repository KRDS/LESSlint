<?php

class Checks_DoNotStyleIds
{
	public function check($line)
	{
		if(preg_match('@^\s?#(.*){@', $line))
			return '*Ids* should not be styled';
	}
}