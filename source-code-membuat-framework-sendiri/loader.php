<?php

// panggil file config
require _BASEPATH_ . 'config.php';

// Autoload Class 
function __autoload($class) 
{
	// Load semua class yang terdapat pada folder 
	if(file_exists( _CORE_ . $class . '.php')) 
	{
		require _CORE_ . $class . '.php';
	}
}

// menjalankan mvc system
$router = new Loader;
$router->init();

?>