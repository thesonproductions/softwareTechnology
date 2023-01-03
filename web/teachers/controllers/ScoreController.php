<?php
require_once "BaseController.php";
class ScoreController extends BaseController{
    public function __construct()
    {
        parent::__construct();
    }
    public function index(){
        $model = $this->model('Score');
        $arr1 = $model->semester();
        $arr2 = $model->class();
        $view = "score/index";
        $this->view($view,[
            'semester'=>$arr1,
            'class'=>$arr2
        ]);
    }
    public function editScore(){
        $view = "score/EditScore";
        $model = $this->model('Score');
        $arr3 = $model->getScore($_GET['student_id'], $_GET['subject_id']);
        $this->view($view,[
           'score'=>$arr3
        ]);
    }
    public function detail(){
        $semester_id = $_GET['id'];
        
        $model = $this->model('Score');

        $arr = $model->getSubjectOfTeacher($semester_id);
        $str = '<option selected>Class Menu</option>';
        if (!empty($arr)){
            foreach($arr as $key => $value){
                $str = $str.'<option value="'.$value->id.'">'.$value->subjects_name.'</option>';
            }
        }

        echo $str;
    }

    public function detailClass(){
        $subject_id = $_GET['id'];
        
        $model = $this->model('Score');

        $arr = $model->getClassOfTeacher($subject_id);

        $str = '<option selected>Class Menu</option>';
        if (!empty($arr)){
            foreach($arr as $key => $value){
                $str = $str.'<option value="'.$value->class_id.'">'.$value->class_name.'</option>';
            }
        }

        echo $str;
    }

    public function score(){

        $class_id = $_GET['class'];
        $semester = $_GET['semester'];
        $subject = $_GET['subject'];
        $model = $this->model('Score');
        $str = "";
        $listStudent = $model->getStudent($class_id,$subject);

        $arr1 = $model->semester();
        $arr2 = $model->class();

        foreach($listStudent as $key => $value){
            $arr3 = $model->getScore($value->id, $value->subjects_id);
            $listStudent[$key] = (object) array_merge((array) $value, (array) $arr3);
        }
        // echo "<pre>";
        // echo print_r($listStudent);
        // die();
        $view = "score/index";
        $this->view($view,[
            'semester'=>$arr1,
            'class'=>$arr2,
            'listStd'=>$listStudent
        ]);
        
        // header("Location: ");
    }

    public function updateScore(){
        echo "<pre>";
        echo print_r($_POST);

        $process = $_POST['process'];
        $mid = $_POST['mid'];
        $end = $_POST['end'];
        $student_id = explode("-", $_POST['idstc'])[0];
        $subject_id = explode("-", $_POST['idstc'])[1];
        $model = $this->model('Score');

        $result = $model->updateScore($process,$mid,$end,$student_id,$subject_id);

        header('location: editScore?student_id=' . $student_id . '&subject_id=' . $subject_id);
    }

    public function activeScore(){
        $subject_id = $_POST['subject_id'];
        $student_id = $_POST['student_id'];
        $model = $this->model('Score');

        $result = $model->updateClassification($student_id, $subject_id);
        $model->activeScore($student_id, $subject_id);
        $response = array('status' => 1);
        if (!$result){
            $response['status'] = 0;
        }

        echo json_encode($response);
    }
}
