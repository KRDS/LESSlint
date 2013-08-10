<?php

class Checks_OpeningBracketInline
{
	public function check($line)
	{
		if(preg_match('#^\s?{#', $line))
			return 'Opening bracket should be inline, not on its own line';
	}
}