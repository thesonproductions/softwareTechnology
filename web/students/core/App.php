<?php
// xử lí url, gọi controller,model,view
class App{
    protected $controller = 'HomeController'; // ten class
    protected $action = 'index'; // ten function
    protected $params = [];
    public function __construct(){}
    public function callUrl($url){
                //[0]=>Home [1] => photos .........
        // echo $this->controller."<br>";
        // echo $this->action;
    //    echo "<pre>";
    //    echo print_r($url);
    //    die();
        if (file_exists("controllers/".$url[0]."Controller.php")){
            $this->controller = ucfirst($url[0]."Controller");
            unset($url[0]);
        }
        require_once "controllers/".$this->controller.".php";
        $this->controller = new $this->controller;

        // xu li action
        if (isset($url[1])){
            if (method_exists($this->controller,$url[1])){
                $this->action = $url[1];
            }
            unset($url[1]);
        }
        // xu li params
        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->action], $this->params );
    }
    
}
