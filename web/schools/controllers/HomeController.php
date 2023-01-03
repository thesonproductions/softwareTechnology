<?php
require_once "BaseController.php";
class HomeController extends BaseController{
    public function __construct()
    {
        parent::__construct();
    }
    public function index(){
        $model = $this->model("User");
        $arr = $model->readUser($_SESSION['id_user']);
        $view = "homes/Index";
        $this->view($view,[
            "user"=>$arr
        ]);
    }
}
?>