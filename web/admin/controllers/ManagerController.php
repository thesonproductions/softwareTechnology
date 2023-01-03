<?php
require_once "BaseController.php";
class ManagerController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $model = $this->model("Manager");
        $listStd = $model->readAllStudent();
        $view = "manager/studentManager";
        $this->view($view, [
            "listStd" => $listStd,
            "model"=>$model
        ]);
    }
    public function teacher()
    {
        $model = $this->model("Manager");
        $listStd = $model->readMember(2);
        $view = "manager/teacherManager";
        $this->view($view, [
            "listStd" => $listStd,
            "model"=>$model
        ]);
    }

    public function employee()
    {
        $model = $this->model("Manager");
        $listStd = $model->readMember(3);
        $view = "manager/employeeManager";
        $this->view($view, [
            "listStd" => $listStd,
            "model"=>$model
        ]);
    }
    public function form(){
        $view = "manager/formManager";
        $this->view($view,[
            
        ]);
    }
    public function addStudent() // Xong
    {
        $fullname = $_POST['fullname'];
        $dob = $_POST['dob'];
        $phoneNumber = $_POST['phonenum'];
        $address = $_POST['address'];
        $classname = $_POST['classname'];
        $date = getdate();
        $crid = ($date['year'] % 1000) * 100;
        $response = array(
            "status" => 1,
            "message" => "Successful"
        );
        $model = $this->model("Manager");
        $result = $model->addStudent($fullname, $dob, $phoneNumber, $address, $classname, $crid);
        if (!$result) {
            $response['status'] = 0;
            $response['message'] = "error";
        }
        echo json_encode($response);
    }
    public function import() // Xong
    {
        $model = $this->model("Manager");
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
                        $fullname   = $line[0];
                        $date_of_birth  = date_create($line[1]);
                        $date_of_birth = date_format($date_of_birth, "Y-m-d");
                        $phone_number  = $line[2];
                        $address = $line[3];
                        $class_name = $line[4];
                        $course_id = $line[5];
                        $result = $model->addStudent($fullname, $date_of_birth, $phone_number, $address, $class_name, $course_id);
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
        header("Location: Manager/index" . $qstring);
    }
    public function export() // Xong
    {
        $filename = "members_" . date('Y-m-d') . ".csv";
        $delimiter = ",";

        $f = fopen('php://memory', 'w');

        $fields = array('id', 'Student ID', 'Full name', 'gender', 'date_of_birth', 'phone number','address','notationlity','cmt');
        fputcsv($f, $fields, $delimiter);
        $model = $this->model("Manager");
        $result = $model->loadAllRows($model->setQuery("SELECT students.id,students.student_id,students.full_name,students.gender,students.date_of_birth,students.phone_number,students.address,students.nationality,students.cmt
                                                        FROM students
                                                        ORDER BY students.id DESC"));
        if (!empty($result)) {
            foreach($result as $key => $value){
                $lineData = array($value->id, $value->student_id, $value->full_name, $value->gender, $value->date_of_birth, $value->phone_number,$value->address,$value->nationality,$value->cmt);
                fputcsv($f, $lineData, $delimiter);
            }
        }

        fseek($f, 0);

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');

        fpassthru($f);


        exit();
    }
    public function addMember()
    {
        $fullname = $_POST['fullname'];
        $dob = $_POST['dob'];
        $phoneNumber = $_POST['phonenum'];
        $address = $_POST['address'];
        $level = $_POST['level'];

        $response = array(
            "status" => 1,
            "message" => "Successful"
        );
        $model = $this->model("Manager");
        $result = $model->addMember($fullname, $dob, $phoneNumber, $address, $level);
        if (!$result) {
            $response['status'] = 0;
            $response['message'] = "error";
        }
        echo json_encode($response);
    }
    public function importMember()
    {
        $level = $_GET['level'];
        $insert = ['teachers', 'managements', 'admins'];
        $model = $this->model("Manager");
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
                        $fullname   = $line[0];
                        $date_of_birth  = date_create($line[1]);
                        $date_of_birth = date_format($date_of_birth, "Y-m-d");
                        $phone_number  = $line[2];
                        $address = $line[3];
                        $result = $model->addMember($fullname, $date_of_birth, $phone_number, $address, $level);
                        // // Check whether member already exists in the database with the same email
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
        $label = ['teacher','employee'];
        // Redirect to the listing page
        header("Location: ".$label[$level-2].$qstring);
    }
    public function exportMember()
    {
        $level = $_GET['level'];
        $insert = ['teachers', 'managements', 'admins'];
        $filename = "member_teachers_" . date('Y-m-d') . ".csv";
        $delimiter = ",";
        
        $f = fopen('php://memory', 'w');

        $fields = array('id', 'Full name', 'date_of_birth', 'phone number','address');
        fputcsv($f, $fields, $delimiter);
        $model = $this->model("Manager");
        $result = $model->loadAllRows($model->setQuery("SELECT id,full_name,date_of_birth,phone_number,address
                                                        FROM ".$insert[$level-2]."
                                                        ORDER BY id DESC"));
        if (!empty($result)) {
            foreach($result as $key => $value){
                $lineData = array($value->id, $value->full_name, $value->date_of_birth, $value->phone_number,$value->address);
                fputcsv($f, $lineData, $delimiter);
            } 
        }

        fseek($f, 0);

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');

        fpassthru($f);

        exit();
    }

    public function modifyMember(){
        $model = $this->model("Manager");
        $insert = ['index','teacher', 'employee'];
        $id = $_GET['id'];
        $level = $_GET['level'];
        $result = $model->modifyMember($id, $level);
        if ($result){
            header("location: " . $insert[$level - 1]);
        }
    }

    public function removeMember(){
        $id = $_GET['id'];
        $level = $_GET['level'];
        $insert = ['index','teacher', 'employee'];
        $model = $this->model("Manager");
        $model->removeAccount($id, $level);
        header("location: " . $insert[$level - 1]);

    }

    public function craeteAllAccount(){
        $response = array(
            "status" => 1
        );
        $date = getdate();
        $yearr = ($date['year'] % 1000);
        $insert = ['students','teachers', 'management', 'admins'];
        $level = $_GET['level'];
        $model = $this->model("Manager");
        $arr = $model->readMember($level);
        foreach($arr as $key => $value){
            $username = $value->full_name;
            $username = strtolower(str_replace(" ", "", $username))."_".$yearr."@".$insert[$level-1].".com";
            $id = $value->id;
            $password = strtolower(str_replace(" ", "", $value->full_name))."aA@";
            $result = $model->insertMember($id, $username, $password, $level);
            if (!$result){
                $response['status'] = 0;
            }
        }
        echo json_encode($response);
        
    }
}
