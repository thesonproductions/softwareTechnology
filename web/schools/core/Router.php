<?php
include_once "App.php";
class Router extends App{
    public function __construct(){
        parent::__construct();
        $url = $this->urlProcess();
        if (!isset($_SESSION['username'])){
            $url[0] = "Login";
            $this->callUrl($url);
        } else{
            $this->callUrl($url);
        }
    }
    public function urlProcess(){
        if (isset($_GET['url'])){
            $url = $_GET["url"];
            return array_values(array_filter(explode('/',$url))); // xoa bo khoang trang o dau ca cuoi cua url
        }
    }
}
?>