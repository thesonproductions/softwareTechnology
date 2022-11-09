<?php

class App{
    protected $controller = "Home";
    protected $action = "index";
    protected $params = [];

    public function solveUrl($url){


    }
    public function urlProcess(){ // ham nay de xu ly url khi truyen tham so vao
        if (isset($_GET['url'])){
            $url = $_GET["url"];
            return array_values(array_filter(explode('/',$url))); // xoa bo khoang trang o dau ca cuoi cua url
        }
    }
}
?>