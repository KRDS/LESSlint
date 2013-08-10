<?php

class Lint
{
	protected $_files	=	[ ];
	protected $_rules;
	protected $_exclude;
	protected $_recursive;

	public function __construct($paths, $rules, $exclude, $recursive)
	{
		$this->_rules		=	$rules;
		$this->_exclude		=	$exclude;
		$this->_recursive	=	$recursive;

		foreach($paths as $path)
		{
			if(is_dir($path))
			{
				if($recursive)
				{
					foreach(self::_recursiveListFiles($path.'*') as $path_tree)
					{
						$glob	=	glob($path_tree.'/*.less');

						if($glob)
							$this->_files	=	array_merge($this->_files, $glob);
					}
				}
				else
				{
					$this->_files	+=	glob($path.'/*.less');
				}
			}
			else if(is_file($path))
			{
				$this->_files[]	=	$path;
			}
			else
			{
				throw new Exception('Unknown path “'.$path.'”');
			}
		}
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

				$ret	.=	'FILE: '.realpath($file).PHP_EOL.PHP_EOL;

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

	protected static function _recursiveListFiles($start)
	{
		static $ret	=	[ ];

		$dirs	=	glob($start.'/*', GLOB_ONLYDIR);

		if(count($dirs) > 0)
		{
			foreach($dirs as $dir)
				$ret[]	=	$dir;
		}

		foreach($dirs as $dir)
			self::_recursiveListFiles($dir);

		return $ret;
	}
}