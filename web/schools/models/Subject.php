<?php
include_once "core/database.php";
class Subject extends database{
    public function __construct()
    {
        parent::__construct();
    }
    public function searchSubject(){
     
        if (isset($_GET['search']) && !empty($_GET['search'])){
            $key1 = $_GET['id_search'];
            $key2 = $_GET['name_search'];
            $key3 = $_GET['class_search'];
            $sql = "SELECT *
            FROM subjects
            WHERE subjects.subjects_id LIKE '%$key1%'
            AND subjects.subjects_name LIKE '%$key2%'
            AND subjects.semester_id LIKE '%$key3%' ";
        } else {
            $sql = "SELECT * FROM subjects";
        }

        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function checkExist($subject_id){
        $sql = "SELECT * FROM subjects WHERE subjects_id = ?";
        $this->setQuery($sql);
        return $this->loadRow(array($subject_id));
    }
    public function addNewSubject($subject_name,$subject_id,$number_of_credit){
        $date = getdate();
        $crid = ($date['year'] % 1000) * 100;
        $sq = "SELECT * FROM subjects WHERE subjects.subjects_id = ?";
        $this->setQuery($sq);
        $arr = $this->loadAllRows(array($subject_id));
        if (!empty($arr)){
            $sql = "UPDATE subjects
                    SET subjects_name = ?,number_of_credits = ?,semester_id=?,updated_at=NOW()
                    WHERE subjects_id = ?";
             $this->setQuery($sql);
             return $this->execute(array($subject_name, $number_of_credit, $crid,$subject_id));
        } else {
            $sql = "INSERT INTO subjects(subjects.id,subjects.subjects_id,subjects.subjects_name,subjects.number_of_credits,subjects.semester_id,subjects.create_at,subjects.updated_at) 
            VALUES (?,?,?,?,?,NOW(),NOW()) ";
             $this->setQuery($sql);
             return $this->execute(array(null, $subject_id, $subject_name, $number_of_credit, $crid));
        }
       
       
    }

    public function editSubject($subject_id,$subject_name,$number_of_credit,$semester_id){
        $sql = "UPDATE subjects
        SET subjects_name = ?,number_of_credits = ?,semester_id=?,updated_at=NOW()
        WHERE subjects_id = ?";
        $this->setQuery($sql);
        return $this->execute(array($subject_name, $number_of_credit, $semester_id,$subject_id));
        
    }
}
?>