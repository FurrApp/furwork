<?php
/*
	* FurWork v1.0
	* Copyright © 2021 | FurrApp
*/
	// Your URL
	define('APP_URL', 'HERE YOUR URL');
	// Your APP Name
	define('APP_NAME', 'HERE YOUR APP NAME');
	// The mode of work
	define('APP_MODE', 'production'); // MODE 
	
	if (@APP_MODE == 'dev'){
		// DEV mode Databse
		define('DB_HOST', 'localhost');
		define('DB_USER', 'USER');
		define('DB_PWD', 'PASSWORD');
		define('DB_NAME', 'DATABASE');

	}elseif (@APP_MODE == 'production') {
		//DB conf for production mode
		define('DB_HOST', 'localhost');
		define('DB_USER', 'USER');
		define('DB_PWD', 'PASSWORD');
		define('DB_NAME', 'DATABASE');
		// Errors
		error_reporting(0);
		// This redirect to 404 Error
	}elseif (@!defined(APP_MODE)) {
		die("Define your constant for continue!");
	}