<?php

class Libraries
{
	var $libpath = _APP_PATH_ . 'libs/'; 

	public function load($filename)
	{
		// cek file apakah ada
		if(file_exists($this->libpath . $filename . '.php'))
		{
			require $this->libpath . $filename . '.php';
		}
	}
}

?>