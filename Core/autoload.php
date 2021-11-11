<?php
// Call all libs
require_once "../Core/config/Conf.php";
require_once "../App/helpers/Default.php";

spl_autoload_register(function($class){
    require_once "libs/" . $class . ".php";
});