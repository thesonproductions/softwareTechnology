<?php
include_once "core/database.php";
class user extends database{
    public function __construct()
    {
        parent::__construct();
    }
    public function checkUser($username,$password){
        $sql = "SELECT * FROM accounts
                WHERE accounts.username = ? AND accounts.password = ?";
        $this->setQuery($sql);
        return $this->loadRow(array($username, md5($password)));
    }
}
?>