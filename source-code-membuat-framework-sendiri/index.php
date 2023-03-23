<?php

// ex : C:www/foo/bar/
define('_BASEPATH_', dirname(realpath(__FILE__)) . '/' );
define('ENVIRONMENT', 'development');
if(defined('ENVIRONMENT')) 
{
	switch(ENVIRONMENT) 
	{
		case 'development': error_reporting(E_ALL); break;
		case 'production': error_reporting(0); break;
		default: exit('The application environment is not set correctly.'); break;
	}
}

// Autoload ( Init )
require _BASEPATH_ . 'loader.php';

?>