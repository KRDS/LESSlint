<?php

class Lint
{
	protected $_path;
	protected $_files;
	protected $_rules;
	protected $_exclude;

	public function __construct($path, $rules, $exclude)
	{
		$this->_path	=	$path;
		$this->_files	=	glob($path);
		$this->_rules	=	$rules;
		$this->_exclude	=	$exclude;
	}

	public function check($return = false)
	{
		$ret	=	null;

		$nb_errors	=	0;
		$nb_files	=	0;

		foreach($this->_files as $file)
		{
			if(in_array(basename($file), $this->_exclude))
				continue;

			$file_check	=	new File($file, $this->_rules);

			$file_check->lint();

			if($file_check->hasErrors())
			{
				$nb_files++;

				$ret	.=	'FILE: '.$file.PHP_EOL.PHP_EOL;

				foreach($file_check->getErrors() as $num => $errors)
				{
					$nb_file_errors	=	count($errors);
					$nb_errors		+=	$nb_file_errors;

					if($nb_file_errors === 1)
					{
						$ret	.=	'line '.($num + 1).', '.$errors[0].PHP_EOL;
					}
					else
					{
						$ret	.=	'line '.($num + 1).': '.PHP_EOL;

						foreach($errors as $error)
							$ret	.=	'   - '.$error.PHP_EOL;
					}
				}

				$ret	.=	PHP_EOL;
			}
		}

		if($ret)
			$ret	=	self::_getLeadCopy($nb_errors, $nb_files).PHP_EOL.PHP_EOL.$ret;
		
		if($return)
			return $ret;
		else
			echo $ret;
	}

	protected static function _getLeadCopy($nb_errors, $nb_files)
	{
		$ret	=	'Found ' .$nb_errors.' error'.($nb_errors !== 1 ? 's' : null);
		$ret	.=	' in '.$nb_files.' file'.($nb_files !== 1 ? 's' : null);

		return $ret;
	}
}