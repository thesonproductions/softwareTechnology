<?php
include_once "core/database.php";
class user extends database{
    public function __construct()
    {
        parent::__construct();
    }
    public function checkUser($username,$password){
        $sql = "SELECT * FROM accounts
                WHERE accounts.username = ? AND accounts.password = ? AND accounts.level = 3";
        $this->setQuery($sql);
        return $this->loadRow(array($username, md5($password)));
    }
    public function readUser($id_user){
        $sql = "SELECT * FROM managements WHERE id = ?";
        $this->setQuery($sql);
        return $this->loadRow(array($id_user));
    }
}
?>