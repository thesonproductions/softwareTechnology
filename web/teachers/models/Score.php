<?php

use function PHPSTORM_META\type;

include_once "core/database.php";
class Score extends database{
    public function __construct()
    {
        parent::__construct();
    }
    public function semester(){
        $sql = "SELECT * FROM semester";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function class(){
        $sql = "SELECT * FROM joins
                INNER JOIN class ON joins.class_id = class.id
                INNER JOIN subjects ON subjects.id = joins.subjects_id
                WHERE joins.teacher_id = ?
                GROUP BY subjects.subjects_id";
        $this->setQuery($sql);
        return $this->loadAllRows(array($_SESSION['id_user']));
    }
    public function getSubjectOfTeacher($semester_id){
        $sql = "SELECT subjects.id, subjects.subjects_name
        FROM subjects,joins 
        WHERE subjects.semester_id = ? AND joins.subjects_id = subjects.id AND joins.teacher_id = ?
        GROUP BY subjects.id";
        $this->setQuery($sql);
        return $this->loadAllRows(array($semester_id, $_SESSION['id_user']));
    }
    public function getClassOfTeacher($subject_id){
        $sql = "SELECT joins.class_id,class.class_name 
                FROM class,joins
                WHERE joins.class_id = class.id AND joins.subjects_id = ?
                GROUP BY joins.class_id";
        $this->setQuery($sql);
        return $this->loadAllRows(array($subject_id));
    }

    // public function getStudent($subject_id,$class_id,$semester_id){
    //     $sql = "SELECT students.id,students.student_id,students.full_name,students.date_of_birth,subjects.subjects_name,subjects.id,score.id,score.point_process,score.midterm_score,score.end_point,subjects.number_of_credits
    //     FROM students,subjects,score,joins
    //     WHERE score.subjects_id = subjects.id 
    //         AND score.student_id = students.id 
    //         AND joins.student_id = students.id 
    //         AND subjects.id = ? 
    //         AND joins.class_id = ? 
    //         AND subjects.semester_id = ?
    //         AND joins.teacher_id = ?";
    //     $this->setQuery($sql);
    //     return $this->loadAllRows(array($subject_id,$class_id,$semester_id,$_SESSION['id_user']));
    // }
    public function getStudent($subject_id,$class_id){
        $sql = "SELECT students.id,students.student_id,students.full_name,students.class_name,students.date_of_birth,joins.subjects_id
            FROM students,joins
            WHERE students.id = joins.student_id AND joins.class_id = ? AND joins.subjects_id = ? AND joins.teacher_id = ?";
        $this->setQuery($sql);
        return $this->loadAllRows(array($class_id, $subject_id, $_SESSION['id_user']));
    }
    public function getScore($student_id,$subject_id){
        $sql = "SELECT score.point_process,score.midterm_score,score.end_point,score.avg,subjects.number_of_credits,subjects.subjects_name,score.active
        FROM score, subjects, students
        WHERE score.subjects_id = subjects.id AND score.student_id = students.id AND students.id = ? AND subjects.id = ?";
        $this->setQuery($sql);
        return $this->loadRow(array($student_id,$subject_id));
    }
    public function avgScore($process,$mid,$end,$fpr=0.2,$fm=0.2,$fe=0.6){
        return $process * $fpr + $mid * $fm + $end * $fe;
    }
    public function updateScore($process,$mid,$end,$student_id,$subject_id){
        $sq = "SELECT *
            FROM score
            WHERE score.student_id = ? AND score.subjects_id = ?";
        $this->setQuery($sq);
        $arr = $this->loadAllRows(array($student_id, $subject_id));
        $avg = $this->avgScore($process, $mid, $end);
     
        if (!empty($arr)){
            $sql = "UPDATE score
            SET score.point_process = ? , score.midterm_score = ? , score.end_point = ? , score.avg = ".$avg."
            WHERE score.student_id = ? AND score.subjects_id = ?";
             $this->setQuery($sql);
             return $this->execute(array($process, $mid, $end, $student_id, $subject_id));
       
        } else {
            $sql = "INSERT INTO score(score.point_process,score.midterm_score,score.end_point,score.avg,score.student_id,score.subjects_id) 
            VALUES (?,?,?,?,?,?)";
             $this->setQuery($sql);
             return $this->execute(array($process, $mid, $end,$avg, $student_id, $subject_id));

        }
       
    }
    public function aboutSubject($subject_id){
        $sql = "SELECT * FROM subjects
            WHERE subjects.id = ?";
            $this->setQuery($sql);
        return $this->loadRow(array($subject_id));
    }
    public function convertFator4($avg){
        if ($avg <= 10 && $avg >= 9){
            return 4;
        } elseif (8.5 <= $avg && $avg < 9){
            return 3.7;
        } elseif (8 <= $avg && $avg < 8.5){
            return 3.5;
        } elseif (7 <= $avg && $avg < 8) {
            return 3;
        }
        elseif (6.5 <= $avg && $avg < 7) {
            return 2.5;
        }
        elseif (5.5 <= $avg && $avg < 6.5) {
            return 2;
        }elseif (5.0 <= $avg && $avg < 5.5) {
            return 1.5;
        }elseif (4 <= $avg && $avg < 5) {
            return 1;
        } else {
            return 0;
        }
    }
    public function updateClassification($student_id,$subject_id){
        $subject = $this->aboutSubject($subject_id);
        $score = $this->getScore($student_id, $subject_id);
        $semester_id = $subject->semester_id;
        $process = $score->point_process;
        $mid = $score->midterm_score;
        $end = $score->end_point;

        $avg = $this->avgScore($process, $mid, $end);
        $avg = $this->convertFator4($avg);
        if ($avg > 2.0){
            $this->updateGraduated($student_id, $avg, $subject->number_of_credits);
        }
        

        $sq = "SELECT *
                FROM classfication
                WHERE classfication.students_id = ? AND classfication.semester_id=".$semester_id;
        $this->setQuery($sq);
        $arr = $this->loadRow(array($student_id));
        if (!empty($arr)){

            $number_credit = $arr->total_credit + $subject->number_of_credits;
            $avg_class = $arr->gpa + $avg * $subject->number_of_credits;
   
            $sql = "UPDATE classfication
            SET classfication.gpa = ? , classfication.total_credit = ?
            WHERE classfication.students_id = ? AND classfication.semester_id=".$semester_id;
            $this->setQuery($sql);
            return $this->execute(array($avg_class, $number_credit, $student_id));
        } else {
            $sql = "INSERT INTO classfication VALUES(null,?,?,?,?,?)";
            $this->setQuery($sql);
            return $this->execute(array($student_id,$subject->semester_id,$avg*$subject->number_of_credits,NULL,$subject->number_of_credits));
        }
    }
    public function activeScore($student_id,$subject_id){
        $sql = "UPDATE score
        SET score.active = 1
        WHERE score.student_id = ? AND score.subjects_id = ?";
         $this->setQuery($sql);
         return $this->execute(array( $student_id, $subject_id));
    }

    public function updateGraduated($student_id,$avg,$number_credit){

        $sq = "SELECT *
                FROM statistical
                WHERE statistical.students_id = ? ";
        $this->setQuery($sq);
        $arr = $this->loadRow(array($student_id));
        if (!empty($arr)){
            $number = $arr->total_credit + $number_credit;
            $avg_class = $arr->gpa + $avg * $number_credit;

            $sql = "UPDATE statistical
            SET statistical.gpa = ? , statistical.total_credit = ?
            WHERE statistical.students_id = ?";
            $this->setQuery($sql);
            return $this->execute(array($avg_class,$number,$student_id));
        } else {
            $sql = "INSERT INTO statistical(id,gpa,students_id,total_credit) VALUES(null,?,?,?)";
            $this->setQuery($sql);
            return $this->execute(array($avg*$number_credit,$student_id,$number_credit));
        }
    }
}
