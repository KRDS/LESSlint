<?php

class File
{
	protected $_lines;
	protected $_checks	=	[ ];

	protected $_errors;

	protected static $_pseudo_classes	=	[ 'active', 'checked', 'default', 'dir', 'disabled', 'empty', 'enabled', 'first', 'first-child', 'first-of-type', 'fullscreen', 'focus', 'hover', 'indeterminate', 'in-range', 'invalid', 'lang', 'last-child', 'last-of-type', 'left', 'link', 'not', 'nth-child', 'nth-last-child', 'nth-last-of-type', 'nth-of-type', 'only-child', 'only-of-type', 'optional', 'out-of-range', 'read-only', 'read-write', 'required', 'right', 'root', 'scope', 'target', 'valid', 'visited', ];

	public function __construct($path, $checks)
	{
		$content	=	file_get_contents($path);
		
		// Escape some uninteresting stuff to avoid messing up with some checks
		$content	=	self::_escapeNonEndOfBlockBrackets($content);
		$content	=	self::_escapeNonEndOfLineSemiColon($content);
		$content	=	self::_escapePseudoClassesColon($content);

		$this->_lines	=	explode(PHP_EOL, $content);
		
		foreach($checks as $check)
		{
			$class_name			=	'Checks_'.$check;
			$this->_checks[]	=	new $class_name;
		}
	}

	public function lint()
	{
		foreach($this->_lines as $num => $line)
		{
			foreach($this->_checks as $check)
			{
				$result	=	$check->check($line);

				if($result)
					$this->_error($result, $num);
			}
		}
	}

	public function getErrors()
	{
		return $this->_errors;
	}

	public function hasErrors()
	{
		return ! empty($this->_errors);
	}

	protected function _error($error, $line)
	{
		if($error)
			$this->_errors[$line][]	=	$error;
	}

	protected static function _escapeNonEndOfBlockBrackets($content)
	{
		return preg_replace('#@{(.*?)}#', '$1', $content);
	}

	protected static function _escapeNonEndOfLineSemicolon($content)
	{
		return preg_replace('#\((?:(?:.*)(;)(?:.*))*\)#e', 'str_replace(\';\', \',\', \'$0\')', $content);
	}

	protected static function _escapePseudoClassesColon($content)
	{
		return preg_replace('#:('.implode('|', self::$_pseudo_classes).')#e', '\'-$1\'', $content);
	}
}