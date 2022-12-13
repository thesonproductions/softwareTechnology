<?php
class BaseController {
    public function __construct()
    {
       
    }

    public function model($model){
        require_once "mvc/models/".$model.".php";
        return new $model;
    }

    public function view($view, $data = []){

        $view = "mvc/views/temp/".$view.".php";
        return require_once "mvc/views/layout.php";
        
    }

}
?>