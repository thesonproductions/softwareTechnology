<script src="public/master/assets/js/jquery-3.6.0.min.js"></script>
<div class="main-wrapper">
    <?php include "views/temp/header.php"; ?>
    <?php include "views/temp/navbar.php"; ?>
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Teacher</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Dashboard / Teacher</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>

            <div class="student-group-form">
                <form id="formStudent" method="GET" action="score/score">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <select class="form-select" aria-label="Default select example" required id="semester"
                                    name="semester">
                                    <option selected>Semester Menu</option>
                                    <?php
                                    foreach ($data['semester'] as $key => $value) {
                                    ?>
                                    <option value="<?php echo $value->semester_id; ?>">
                                        <?php echo $value->semester_name . " - " . $value->school_year; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <select class="form-select" aria-label="Default select example" required id="subject"
                                    name="subject">


                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <select class="form-select" aria-label="Default select example" required id="class"
                                    name="class">


                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="search-student-btn">
                                <input type="submit" class="btn btn-primary" id="search" name="search" value="search">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">

                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title">Subjects</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp" style="display: flex;">
                                    <!-- Export -->
                                    <a href="subject/export" class="btn btn-outline-warning me-2"><i
                                            class="fa-sharp fa-solid fa-download"></i>
                                        Export</a>

                                    <a href="subject/addSubject" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table
                                class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                <thead class="student-thread">
                                    <tr>
                                        <th>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </th>
                                        <th>Student ID</th>
                                        <th>Full Name</th>
                                        <th>Class</th>
                                        <th>Subject Name</th>
                                        <th>date of birth</th>
                                        <th>Number Of Credits</th>
                                        <th>Process Score</th>
                                        <th>Mid Score</th>
                                        <th>End Score</th>
                                        <th>AVG Score</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="studentList">
                                    <?php
                                        if (isset($data['listStd'])){
                                            foreach($data['listStd'] as $key => $value){
                                    ?>
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </td>
                                        <td><?php echo $value->student_id; ?></td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="" class="avatar avatar-sm me-2"><img
                                                        class="avatar-img rounded-circle"
                                                        src="public/master/assets/img/profiles/thumbnail.png"
                                                        alt="User Image"></a>
                                                <a href=""><?php echo $value->full_name; ?></a>
                                            </h2>
                                        </td>
                                        <td><?php echo $value->class_name; ?></td>
                                        <td><?php echo $value->subjects_name; ?></td>
                                        <td><?php echo $value->date_of_birth; ?></td>
                                        <td><?php echo $value->number_of_credits; ?></td>
                                        <td><?php echo $value->point_process; ?></td>
                                        <td><?php echo $value->midterm_score; ?></td>
                                        <td><?php echo $value->end_point; ?></td>
                                        <td><?php echo $value->avg; ?></td>
                                        <td class="text-end">
                                            <div class="actions " style="display:<?php echo $value->active == 0 ? 'block' : 'none' ?>;">
                                                <a href="score/editScore?student_id=<?php echo $value->id; ?>&subject_id=<?php echo $value->subjects_id; ?>"
                                                    class="btn btn-sm bg-danger-light">
                                                    <i class="feather-edit"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                            }
                                        }
                                        
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>Copyright © 2022 Dreamguys.</p>
    </footer>

</div>

</div>
<script src="public/master/assets/js/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#semester').change(function() {
        var id = $('#semester').val();
        $('#subject').html("")
        $.ajax({
            url: "score/detail",
            type: "GET",
            data: {
                id: id
            },
            success: function(data) {
                $('#subject').html(data)
            }
        })
    })
    $('#subject').change(function() {
        var id = $('#subject').val();
        $('#class').html("")
        $.ajax({
            url: "score/detailClass",
            type: "GET",
            data: {
                id: id
            },
            success: function(data) {
                $('#class').html(data)
            }
        })
    })
    // $('#formStudent').on('submit', function(e) {
    //     e.preventDefault();
    //     var semester = $('#semester').val()
    //     var subject = $('#subject').val()
    //     var classd = $('#class').val()
    //     var data = {
    //         semester: semester,
    //         subject: subject,
    //         class: classd
    //     }
    //     $.ajax({
    //         url: "score/score",
    //         type: "GET",
    //         data: data,
    //         success: function(data) {
    //             $('#studentList').html(data)
    //         }
    //     })
    // })
})
</script>