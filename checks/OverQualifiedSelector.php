<?php

class Checks_OverQualifiedSelector
{
	public static function check($line)
	{
		if(preg_match('#\s(?:[a-z]+)\.(.*?)\s#i', $line, $matches))
		{
			return 'Avoid over-qualified selectors. Found “'.trim($matches[0]).'”';
		}
	}
}