<?php
include "BaseController.php";
class LoginController extends BaseController {
    public function __construct(){
       parent::__construct(); 
    }
    public function index(){
        require_once 'views/temp/Login/Login.php';
    }
    public function formLogin(){
        $response = array(
            "status" => 1,
            "message" => "An error has occurred during login, please try again"
        );
        $username = $_POST['username'];
        $password = $_POST['password'];
        $model = $this->model("User");
        $arr = $model->checkUser($username, $password);
        if (!empty($arr)){
            if ($arr->status == 1){
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                $_SESSION['id_user'] = $arr->id_user;
                $response['message'] = "Login successful!";
            } else{
                header('location: views/temp/error/index.php');
            }
        } else{
            $response['status'] = 0;
            $response['message'] = "unknown account or incorrect password, please try again";
        }
        echo json_encode($response);
    }

    public function logout(){
        if (isset($_SESSION['username'])){
            unset($_SESSION['username']);
            unset($_SESSION['password']);
        }
        header('location: index');
    }
}
?>