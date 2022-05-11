<?php



include_once("Controllers/controller_" .$controller.".php");
$objController =  "Controller".ucfirst($controller);
$controller = new $objController();
$controller ->$action();



?>