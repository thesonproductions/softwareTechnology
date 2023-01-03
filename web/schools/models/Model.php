<?php
include_once "core/database.php";
class model extends database{
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
}
?>