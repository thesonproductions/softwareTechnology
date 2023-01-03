<?php
include_once "core/database.php";
class Manager extends database{
    public function __construct()
    {
        parent::__construct();
    }
    public function addStudent($fullname,$dob,$phonenum,$address,$classname,$crid){
        
        $sql = "INSERT INTO students(id,student_id,full_name,date_of_birth,phone_number,address,class_name,course_id,create_at,updated_at)
                VALUES (?,?,?,?,?,?,?,?,NOW(),NOW())";
        $last_id = $this->getLastId();
        $student_id = $crid * 10000 + $last_id;
        $this->setQuery($sql);
        return $this->execute(array(null,$student_id,$fullname, $dob, $phonenum, $address, $classname,$crid));
    }
    public function readAllStudent(){
        $sql = "SELECT * FROM students";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    public function addMember($fullname,$dob,$phonenum,$address,$level){
        $insert = ['teachers', 'managements', 'admins'];
        $sql = "INSERT INTO ".$insert[$level - 2]."(id,full_name,date_of_birth,phone_number,address,create_at,updated_at)
        VALUES (?,?,?,?,?,NOW(),NOW())";
        $this->setQuery($sql);
        return $this->execute(array(null,$fullname, $dob, $phonenum, $address));
    }
    public function readMember($level){
        $insert = ['students','teachers', 'managements', 'admins'];
        $sql = "SELECT * FROM " . $insert[$level - 1];
        $this->setQuery($sql);
        return $this->loadAllRows(array($level));
    }
    public function modifyMember($id,$level){
        $sqll = "SELECT * FROM accounts WHERE accounts.id_user = ? AND accounts.level = ?";
        $this->setQuery($sqll);
        $arr = $this->loadRow(array($id, $level));
        $status = $arr->status == 1 ? 0 : 1;
        $sql = "UPDATE accounts
                SET accounts.status = ?
                WHERE accounts.id_user = ? AND accounts.level = ?";
        $this->setQuery($sql);
        return $this->execute(array($status,$id,$level));
    }

    public function readAccount($id,$level){
        $sql = "SELECT * FROM accounts WHERE accounts.id_user = ? AND accounts.level = ?";
        $this->setQuery($sql);
        return $this->loadRow(array($id, $level));
    }

    public function removeAccount($id,$level){
        $insert = ['students','teachers','managements'];
        $sql = "DELETE FROM " . $insert[$level - 1] . " WHERE id = ?";
        $this->setQuery($sql);
        $this->execute(array($id));
        $sql2 = "DELETE FROM accounts WHERE id = ? AND level = ?";
        $this->setQuery($sql2);
        $this->execute(array($id,$level));
    }
    public function insertMember($id_user,$username,$password,$level){
        // $insert = ['students','teachers', 'managements', 'admins'];
        $sq = "SELECT * FROM accounts WHERE id_user = ? AND level = ?";
        $this->setQuery($sq);
        $arr = $this->loadAllRows(array($id_user, $level));
        if (!empty($arr)){
            return false;
        } else {
            $sql = "INSERT INTO accounts(id,id_user,username,password,level,create_at,status) VALUES (?,?,?,?,?,NOW(),1)";
            $this->setQuery($sql);
            $this->execute(array(null,$id_user, $username, md5($password), $level));
            return true;
        }

       
    }
 
}
?>