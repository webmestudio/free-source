<?php

class Loader 
{
	function __construct()
	{
		$this->router = new Router();
	}

	function init() 
	{
		// Auto ditect direktori router
		$this->router->setBasePath(_BASE_PROJECT_);

		// manual set router
		$dir = _APP_PATH_ . "controllers/";
		$scan = array_diff(scandir($dir, 1), array('..', '.'));
		foreach ($scan as $value) 
		{
			require $dir . $value ;
		}

		// load router
		require _BASEPATH_ . 'routes/web.php';

		$match = $this->router->match();
		if ($match === false) {
		    // here you can handle 404
		} else {
		    list( $controller, $action ) = explode( '#', $match['target'] );
		    if ( is_callable(array($controller, $action)) ) {
		    	$obj = new $controller();
		        call_user_func_array(array($obj,$action), array($match['params']));
		    } else {
		        // here your routes are wrong.
		        // Throw an exception in debug, send a  500 error in production
		    }
		}
	}
}

?>