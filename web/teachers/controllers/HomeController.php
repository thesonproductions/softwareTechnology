<?php
require_once "BaseController.php";
class HomeController extends BaseController{
    public function __construct()
    {
        parent::__construct();
    }
    public function index(){
        $view = "homes/index";
        $this->view($view);
    }
    public function profile(){
        $view = "homes/profile";
        $this->view($view);
    }
}
?>