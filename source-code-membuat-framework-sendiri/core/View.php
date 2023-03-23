<?php 

class View 
{
	var $viewpath = _APP_PATH_ . 'views/';

	public function get($filename) 
	{	
		// cek file apakah ada
		if(file_exists($this->viewpath . $filename . '.php'))
		{
			require $this->viewpath . $filename . '.php';
		}
	}
}

?>