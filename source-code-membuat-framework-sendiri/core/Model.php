<?php 

class Model 
{
	var $modelpath = _APP_PATH_ . 'models/';

	function __construct() 
	{
		// buat objek jembatan koneksi ke database
		// parameter constanta terdapat di file config.php
		//$this->db = new Database(DB_ENGINE, DB_HOST = null, DB_USER, DB_PASS, DB_PORT);
	}

	function load($filename) 
	{
		// cek file apakah ada
		if(file_exists($this->modelpath . $filename . '_Model.php'))
		{
			require $this->modelpath . $filename . '_Model.php';
			$modelname = $filename . '_Model';
			$this->get = new $modelname();
		}
	}

}

?>