<?php

require __DIR__.'/inc/file.php';
require __DIR__.'/inc/lint.php';

//$path	=	'*.less';
$path	=	'/Applications/MAMP/htdocs/Feedizr/public/assets/less/*.less';

$rules	=	[
	'IndentWithTabs',
	'NotImportant',
	'OneSpaceBeforeBracket',
	'WrongIndent',
	'ClosingBracketOnItsOwnLine',
	'ValidCssProperty',
	'OnePropertyPerLine',
	'ColonSpacing',
	'OverQualifiedSelector',
];

$rules	=	[
	'OverQualifiedSelector'
	//'PropertyRepeated'
];

$exclude	=	['lesshat.less'];

$lint	=	new Lint($path, $rules, $exclude);
$lint->check();