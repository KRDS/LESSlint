<?php

class Checks_WrongIndent
{
	protected $_indent	=	0;

	public function check($line)
	{
		$ret	=	false;

		if( ! preg_match('#^\s*$#', $line)) // Skip empty lines
		{
			$has_opening_bracket	=	strpos($line, '{') !== false;
			$has_closing_bracket	=	strpos($line, '}') !== false;

			if($has_opening_bracket && $has_closing_bracket)
				return;

			if($has_closing_bracket) // Closing bracket: remove one level of indent
				$this->_indent--;

			if($this->_indent < 0)
				$this->_indent	=	0;

			if($this->_indent === 0)
				$ret	=	! preg_match('#^([^\s])#', $line);
			else
				$ret	=	! preg_match('#^([\t]{'.$this->_indent.'})[^\t]#', $line);

			if($has_opening_bracket) // Opening bracket: add one level of indent
				$this->_indent++;
		}

		if($ret)
		{
			$s	=	$this->_indent != 1 ? 's' : null;

			return 'This line should be indented with '.$this->_indent.' tab'.$s;
		}
	}
}