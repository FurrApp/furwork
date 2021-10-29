<?php
/* Maping URL
	* 1 - GET controller
	* 2 - SELECT Method
	* 3 - GET Params (optional)
*/

class Core{
	// Using default view
	protected $actualController = APP_DEFAULT_CONTROLLER;
	protected $actualMethod = 'index';
	protected $params = [];

	public function __construct(){
		$url = $this->getURL();
		// Check if exist the controller
		if (file_exists('app/controllers/' . @ucwords($url[0]) . '.php')) {
			$this->actualController = ucwords($url[0]);
			// Recicle var 
			unset($url[0]);
		}elseif(empty($url[0])){
			$this->actualController = ucwords(APP_DEFAULT_CONTROLLER);
			unset($url[0]);
		}elseif(!empty($url[0]) && !file_exists('../app/controllers/' . @ucwords($url[0]) . '.php')) {
			if (APP_MODE == 'dev') {
				die('Add controller at <code>app/controllers/</code> folder');
			}elseif(APP_MODE == 'production') {
				require_once "../app/views/errors/404.php";
				unset($url[0]);
				exit();
			}
		}
		// Call the controller
		require_once "../app/controllers/" . ucwords($this->actualController) . '.php';
		$this->actualController = new $this->actualController;

		// Check the Method
		if (isset($url[1])) {
			if (method_exists($this->actualController, $url[1])) {
				$this->actualMethod = $url[1];
				unset($url[1]);
			}elseif (!method_exists($this->actualController, $url[1])) {
				if (APP_MODE == 'dev') {
					die('Add the method <code>' . ucwords($url[1]) . '</code> in the controllers.' );
				}elseif (APP_MODE == 'production'){
					require_once "../app/views/errors/3xx.php";
					unset($url[0]);
					exit();
				}
			}
		}
		$this->params = $url ? array_values($url) : [];
		call_user_func_array([$this->actualController, $this->actualMethod], $this->params);
	}

	public function getURL(){
		if (isset($_GET['url'])) {
			//rtrim() Cut all lashes
			$url = rtrim($_GET['url'], "/");
			$url = filter_var($url, FILTER_SANITIZE_URL);
			$url = explode('/', $url);
			return $url;
		}
	}
}
