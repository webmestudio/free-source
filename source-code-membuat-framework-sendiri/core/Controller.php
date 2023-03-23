<?php 

class Controller 
{
	var $controllerpath = _APP_PATH_ . "controllers/";

	/**
	 * initialize class
	 */
	public function __construct() 
	{
		// membuat objek untuk menghubungkan dengan class views
		$this->view = new View();
		// membuat objek untuk menghubungkan dengan class model
		$this->model = new Model();
	}

}

?>