<?php
class Router{
    public function __construct(){
        if (isset($_SESSION["email"])){
            echo(123);
        } else {
            require_once("views/login.php");
        }
    }
}
?>