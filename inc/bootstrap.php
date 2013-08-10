<?php

require __DIR__.'/lint.php';
require __DIR__.'/file.php';

spl_autoload_register(function($name)
{
	require __DIR__.'/../checks/'.substr($name, 7).'.php';
});