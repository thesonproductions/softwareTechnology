<?php
require_once "BaseController.php";
class ManagerController extends BaseController{
    public function __construct()
    {
        parent::__construct();
    }
    public function index(){
        $model = $this->model('Manager');
        $faculity = $model->searchFaculity();
        $view = "manager/manager";
        $this->view($view,[
            "faculity" => $faculity,
        ]);
    }
    public function scholarship(){
        $model = $this->model('Manager');
        $view = "manager/scholarship";
        $this->view($view,[
          'semester'=>$model->semester()
        ]);
    }
    public function alert(){
        $model = $this->model('Manager');
        $view = "manager/alert";
        $this->view($view,[
          'semester'=>$model->semester()
        ]);
    }
    public function graduated(){
        $view = "manager/graduated";
        $this->view($view,[
          
        ]);
    }
    public function ajaxFaculity(){
        $id = $_GET['id'];
        $pieces = explode("-", $id);

        $model = $this->model("Manager");
        $arr = $model->searchMajor($pieces[0]);
        $str = "<option selected>Select major</option>";
   
        if (!empty($arr)){
            foreach($arr as $key => $value){
                $str = $str.'<option value="'.$value->id.'">'.$value->major_name.'</option>';
            }
        }

        echo $str;
    }
    public function ajaxClass(){
        $id = $_GET['id'];

        $model = $this->model("Manager");
        $arr = $model->searchClass($id);
        $str = "<option selected>Select Class</option>";
   
        if (!empty($arr)){
            foreach($arr as $key => $value){
                $str = $str.'<option value="'.$value->id.'">'.$value->class_name.'</option>';
            }
        }

        echo $str;
    } 

    public function loadClassStudent(){
  
        $faculity_id = $_GET['faculity'];
        $major_id = $_GET['major'];
        $class_id = $_GET['class'];

        $model = $this->model('Manager');
        $arr = $model->readStudentClass($class_id);
        $faculity = $model->searchFaculity();
        $view = "manager/manager";
        $this->view($view,[
            "arr" => $arr,
            "faculity" => $faculity,
        ]);
    }

    public function reviewScholarship(){
        $model = $this->model('Manager');
        $id = $_GET['id'];
        $id = explode("-", $id)[1];
        $arr = $model->reviewScholership($id);
        $str = "";
        foreach($arr as $key => $value){
            $avg = ($value->gpa) / $value->total_credit;
            $arr[$key] = (object) array_merge((array) $value,array('avg'=> $avg));
            if ($avg > 3.2){
                $str = $str . '<tr>
                                <td>'.$value->student_id.'</td>
                                <td>
                                     <h2>
                                        <a>'.$value->full_name.'</a>
                                    </h2>
                                </td>
                                <td>'.$value->faculity_name.'</td>
                                <td>'.$value->total_credit.'</td>
                                <td>'.round($avg,2).'</td>
                                <td>17 Aug 2022</td>
                                <td>Distinction</td>
            </tr>';
            } elseif (2.5 <= $avg && $avg <3.2) {
                $str = $str . '<tr>
                                <td>'.$value->student_id.'</td>
                                <td>
                                     <h2>
                                        <a>'.$value->full_name.'</a>
                                    </h2>
                                </td>
                                <td>'.$value->faculity_name.'</td>
                                <td>'.$value->total_credit.'</td>
                                <td>'.round($avg,2).'</td>
                                <td>17 Aug 2022</td>
                                <td>Pass</td>
            </tr>';
            }
        }
        echo $str;
    }

    public function export(){
        $filename = "scholarship_" . date('Y-m-d') . ".csv";
        $delimiter = ",";

        $f = fopen('php://memory', 'w');

        $fields = array('ID', 'Name','Faculty', 'Completed Credits','GPA','Graduated Date','Classification');
        fputcsv($f, $fields, $delimiter);

        $model = $this->model('Manager');
        $id = $_GET['id'];
        $arr = $model->reviewScholership($id);
        foreach ($arr as $key => $value) {
            $avg = ($value->gpa) / $value->total_credit;
            $arr[$key] = (object) array_merge((array) $value, array('avg' => $avg));
        }
        if (!empty($arr)) {
            foreach($arr as $key => $value){
                $lineData = array($value->student_id, $value->full_name, $value->faculity_name, $value->total_credit,round($avg,2));
                fputcsv($f, $lineData, $delimiter);
            }
        }

        fseek($f, 0);

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');

        fpassthru($f);


        exit();
    }

    public function reviewAlert(){
        $model = $this->model('Manager');
        $id = $_GET['id'];
        $id = explode("-", $id)[1];
        $arr = $model->reviewScholership($id);
        $str = "";
        foreach($arr as $key => $value){
            $avg = ($value->gpa) / $value->total_credit;
            $arr[$key] = (object) array_merge((array) $value,array('avg'=> $avg));
            if ($avg <= 1) {
                $str = $str . '<tr>
                                <td>' . $value->student_id . '</td>
                                <td>
                                     <h2>
                                        <a>' . $value->full_name . '</a>
                                    </h2>
                                </td>
                                <td>' . $value->faculity_name . '</td>
                                <td>' . $value->total_credit . '</td>
                                <td>' . round($avg, 2) . '</td>
                                <td>too lazy to study</td>
                                <td>Alert</td>
            </tr>';
            }
        }
        echo $str;
    }
}
?>