<?php

class ControllerPages{
    public function home(){

        include_once("Views/pages/home.php");
    }

    public function Error(){

        include_once("Views/pages/Error.php");
    }
}

?>