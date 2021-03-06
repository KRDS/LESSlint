<?php

class File
{
	protected $_lines	=	[ ];
	protected $_checks	=	[ ];

	protected $_errors;

	protected static $_pseudo_classes	=	[ 'active', 'checked', 'default', 'dir', 'disabled', 'empty', 'enabled', 'first', 'first-child', 'first-of-type', 'fullscreen', 'focus', 'hover', 'indeterminate', 'in-range', 'invalid', 'lang', 'last-child', 'last-of-type', 'left', 'link', 'not', 'nth-child', 'nth-last-child', 'nth-last-of-type', 'nth-of-type', 'only-child', 'only-of-type', 'optional', 'out-of-range', 'read-only', 'read-write', 'required', 'right', 'root', 'scope', 'target', 'valid', 'visited', ];

	public function __construct($path, $rules)
	{
		$content	=	file_get_contents($path);

		$content	=	self::_filterContentToIgnore($content);
		
		if( ! $content)
			return;
		
		// Escape a couple of tricky stuff to avoid messing up with some checks
		$content	=	self::_escapeNonEndOfBlockBrackets($content);
		$content	=	self::_escapeNonEndOfLineSemiColon($content);
		$content	=	self::_escapePseudoClassesColon($content);

		$this->_lines	=	preg_split('/\R/', $content); 

		foreach($rules as $rule => $settings)
		{
			if($settings !== false)
			{
				$class_name			=	'Checks_'.$rule;
				$this->_checks[]	=	new $class_name($settings);
			}
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

	public function hasErrors()
	{
		return ! empty($this->_errors);
	}

	public function getErrors()
	{
		return $this->_errors;
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
		return preg_replace('#\((?:.*;.*)*\)#e', 'str_replace(\';\', \',\', \'$0\')', $content);
	}

	protected static function _escapePseudoClassesColon($content)
	{
		return preg_replace('#:('.implode('|', self::$_pseudo_classes).')#e', '\'-$1\'', $content);
	}
	
	protected static function _filterContentToIgnore($content)
	{
		//Ignore file check
		if(preg_match('#LessLint\:[\s]?skip#usi', $content))
			return false;
			
		//Ignore code part check
		$ignr_pattern		=	'#\/\*[\s]?LessLint\:[\s]?ignore.*?/LessLint\:[\s]?ignore[\s]?\*\/#usi';
		
		//Keep the true number of lines for easier error debugging.
		if(preg_match_all($ignr_pattern, $content, $matches))
		{
			$ign_blocks	=	array();
			
			foreach($matches[0] as $i => $match)
				$ign_blocks[$i]	=	count(preg_split('/\R/', $match)); //nb of ignored lines
			
			$cnt	=	count($ign_blocks);
			
			for($i = 0; $i < $cnt; $i++)
				$content	=	preg_replace($ignr_pattern, str_repeat("\n", $ign_blocks[$i] - 1), $content, 1);
		}
		
		return $content;
	}
}
