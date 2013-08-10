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

		spl_autoload_register(function($name)
		{
			require __DIR__.'/../checks/'.substr($name, 7).'.php';
		});
	}

	public function check($return = false)
	{
		$ret	=	null;

		foreach($this->_files as $file)
		{
			if(in_array(basename($file), $this->_exclude))
				continue;

			$file_check	=	new File($file, $this->_rules);

			$file_check->lint();

			if($file_check->hasErrors())
			{
				$ret	.=	'FILE: '.$file.PHP_EOL.PHP_EOL;

				foreach($file_check->getErrors() as $num => $errors)
				{
					if(count($errors) === 1)
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
		
		if($return)
			return $ret;
		else
			echo $ret;
	}
}