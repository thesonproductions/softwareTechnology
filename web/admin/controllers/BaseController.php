<?php
class BaseController {
    public function __construct(){}

    public function model($model){
        require_once "models/".$model.".php";
        return new $model;
    }

    public function view($view, $data = []){

        $view = "views/temp/".$view.".php";
        return require_once "views/layout.php";
        
    }

}
?>