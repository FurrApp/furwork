<?php
/*
	* [[ -- Principal controller -- ]]
	* Load all views and models
*/
class AppController{
	// Load Model
	public function model($model){
		require_once '../app/models/' . $model . '.php';
		return new $model();
	}
	// Load Views
	public function view($view, $params = []){
		if (file_exists('../app/views/' . $view . '.php')) {
			require_once '../app/views/' . $view . '.php';
		}else{
			if (APP_MODE == 'dev') {
				die("View not exist!");
			}elseif (APP_MODE == 'production') {
				require_once "../app/views/errors/404.php";
			}
		}
	}
}
