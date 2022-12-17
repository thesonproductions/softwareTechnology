<?php
require_once "BaseController.php";
class HomeController extends BaseController{
    public function __construct()
    {
        parent::__construct();
    }
    public function index(){
        $view = "homes/Index";
        $this->view($view);
    }
}
?>