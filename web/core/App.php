<?php

class App{
    protected $controller = "HomeComtroller";
    protected $action = "index";
    protected $params = [];

    public function solveUrl($url){


    }
    public function callUrl($url){
        if (file_exists("controllers/".$url[0]."Controller.php")){
            $this->controller = $url[0]."Controller";
        }
        require_once "controllers/".$this->controller."php";
        
    }

    public function urlProcess(){ // ham nay de xu ly url khi truyen tham so vao
        if (isset($_GET['url'])){
            $url = $_GET["url"];
            return array_values(array_filter(explode('/',$url))); // xoa bo khoang trang o dau ca cuoi cua url
        }
    }
}
?>