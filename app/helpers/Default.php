<?php
/*
	* Default helpers
	* Can be Add Others
*/
function to($url = ['']){
	header("Location: " . APP_URL . "/" . $url . "/");
}