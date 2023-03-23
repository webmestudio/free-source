<?php

class Example extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->view->pagetitle = "Example";
		$this->view->get('example');

		$this->model->load('example');

		$this->model->get->demo();
	}

	function post()
	{
		echo  'ini post';
	}
}

?>