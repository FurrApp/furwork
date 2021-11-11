<?php
/*
	* FurWork v1.0
	* Copyright © 2021 | FurrApp
*/
	// Your URL
	define('APP_URL', 'http://localhost/furwork');
	// Your APP Name
	define('APP_NAME', 'YOUR APP');
	// controller default
	define('APP_DEFAULT_CONTROLLER', 'pages');
	// default index page
	define('APP_DEFAULT_PAGE', 'index');
	// The mode of work
	define('APP_MODE', 'production'); // MODE
	
	if (APP_MODE == 'dev'){
		// DEV mode Databse
		define('DB_HOST', 'localhost');
		define('DB_USER', 'root');
		define('DB_PWD', '');
		define('DB_NAME', '');
	}elseif (APP_MODE == 'production') {
		//DB conf for production mode
		define('DB_HOST', 'localhost');
		define('DB_USER', '');
		define('DB_PWD', '');
		define('DB_NAME', '');
		// Errors
		error_reporting(0);
		// This redirect to 404 Error
	}
	if(!defined('APP_MODE')){
		die('APP_MODE is not defined');
	}
	// Set default timezone
	date_default_timezone_set('America/Mexico_City');
