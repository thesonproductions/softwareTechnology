<?php
include_once "core/database.php";
class Manager extends database{
    public function __construct()
    {
        parent::__construct();
    }
    public function searchFaculity(){
        $sql = "SELECT * FROM faculity";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    public function searchMajor($id){
        $sql = "SELECT specialization_major.id,specialization_major.major_name
        FROM faculity,specialization_major
        WHERE faculity.id = specialization_major.faculity_id AND faculity.id = ?";

        $this->setQuery($sql);
        return $this->loadAllRows(array($id));
    }

    public function searchClass($id){
        $sql = "SELECT class.id,class.class_id,class.class_name
        FROM class
        INNER JOIN specialization_major ON specialization_major.id = class.major_id
        WHERE specialization_major.id = ?";
        $this->setQuery($sql);
        return $this->loadAllRows(array($id));
    }

    public function readStudentClass($id){
        $sql = "SELECT students.id,students.student_id,students.full_name,students.date_of_birth,class.class_name,specialization_major.major_name,faculity.faculity_name
        FROM students, class,joins,specialization_major,faculity
        WHERE students.id = joins.student_id AND joins.class_id = class.id AND class.faculity_id = faculity.id AND class.major_id = specialization_major.id AND joins.class_id = ?
        GROUP BY students.student_id
        ORDER BY students.id ASC";
        $this->setQuery($sql);
        return $this->loadAllRows(array($id));
    }
    public function semester(){
        $sql = "SELECT * FROM semester";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    public function reviewScholership($semester_id){
        $sql = "SELECT students.student_id,students.full_name,faculity.faculity_name,classfication.total_credit,classfication.gpa
        FROM classfication,students,faculity
        WHERE classfication.students_id = students.id AND students.faculty_id = faculity.id AND classfication.semester_id = ?";
        $this->setQuery($sql);
        return $this->loadAllRows(array($semester_id));
    }
}
?>