<?php
require_once "BaseController.php";
class SubjectController extends BaseController{
    public function __construct()
    {
        parent::__construct();
    }
    public function index(){
        $model = $this->model("Model");
        $arr = $model->searchSubject();
        $view = "subjects/subjectList";
        $this->view($view,[
            "list"=>$arr
        ]);
    }
    
    public function addSubject(){
        $view = "subjects/addSubject";
        $this->view($view,[

        ]);
    }

    public function editSubject(){
        $model = $this->model("Subject");
        $view = "subjects/editSubject";
        $this->view($view,[
            "user"=>$model->checkExist($_GET['id'])
        ]);
    }
    public function import() // Xong
    {
        header("Content-type: text/html; charset=utf-8");
        $model = $this->model("Subject");
        if (isset($_FILES['file'])) {
            // Allowed mime types
            $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

            // Validate whether selected file is a CSV file
            if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)) {

                // If the file is uploaded
                if (is_uploaded_file($_FILES['file']['tmp_name'])) {

                    // Open uploaded CSV file with read-only mode
                    $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

                    // Skip the first line
                    fgetcsv($csvFile);

                    // Parse data from CSV file line by line
                    while (($line = fgetcsv($csvFile)) !== FALSE) {
                        // Get row data

                        $id = $line[0];
                        $subject_name = $line[1];
                        $subject_id = $line[2];
                        $number_of_credit = $line[3];
                        if (!empty($model->checkExist($subject_id))){
                            continue;
                        } else {
                            $result = $model->addNewSubject($subject_name,$subject_id,$number_of_credit);
                        }
                        
                        // Check whether member already exists in the database with the same email
                        // $prevQuery = "SELECT id FROM members WHERE email = '" . $line[1] . "'";
                        // $prevResult = $db->query($prevQuery);

                        // if ($prevResult->num_rows > 0) {
                        //     // Update member data in the database
                        //     $db->query("UPDATE members SET name = '" . $name . "', phone = '" . $phone . "', status = '" . $status . "', modified = NOW() WHERE email = '" . $email . "'");
                        // } else {
                        //     // Insert member data in the database
                        //     $db->query("INSERT INTO members (name, email, phone, created, modified, status) VALUES ('" . $name . "', '" . $email . "', '" . $phone . "', NOW(), NOW(), '" . $status . "')");
                        // }
                    }

                    // Close opened CSV file
                    fclose($csvFile);

                    $qstring = '?status=succ';
                } else {
                    $qstring = '?status=err';
                }
            } else {
                $qstring = '?status=invalid_file';
            }
        }

        // Redirect to the listing page
        header("Location: subject/index" . $qstring);
    }
    public function export() // Xong
    {
        $filename = "subject_" . date('Y-m-d') . ".csv";
        $delimiter = ",";

        $f = fopen('php://memory', 'w');

        $fields = array('id', 'Subject Name','Subject id', 'Credit of Number');
        fputcsv($f, $fields, $delimiter);
        $model = $this->model("Subject");
        $result = $model->loadAllRows($model->setQuery("SELECT subjects.id,subjects.subjects_name,subjects.subjects_id,subjects.number_of_credits FROM subjects
                                                        ORDER BY subjects.id ASC"));
        if (!empty($result)) {
            foreach($result as $key => $value){
                $lineData = array($value->id, $value->subjects_name, $value->subjects_id, $value->number_of_credits);
                fputcsv($f, $lineData, $delimiter);
            }
        }

        fseek($f, 0);

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');

        fpassthru($f);


        exit();
    }

    public function addNewSubject(){
        $model = $this->model("Subject");
        $subject_id = $_GET['subject_id'];
        $subject_name = $_GET['subject_name'];
        $number_of_credit = $_GET['number_of_credit'];

        $result = $model->addNewSubject($subject_name, $subject_id, $number_of_credit);
        $response = array(
            'status' => 0
        );
        if ($result){
            $response['status'] = 1;
        }

        echo json_encode($response);
    }
    public function editNewSubject(){
        $subjects_id = $_GET['subjects_id'];
        $subjects_name = $_GET['subjects_name'];
        $semester_id = $_GET['semester_id'];
        $number_of_credit = $_GET['number_of_credit'];
        $model = $this->model("Subject");
        $result = $model->editSubject($subjects_id,$subjects_name,  $number_of_credit,$semester_id);
        $response = array('status' => 1);
        if (!$result){
            $response['status'] = 0;
        }

        echo json_encode($response);
    }
}
?>