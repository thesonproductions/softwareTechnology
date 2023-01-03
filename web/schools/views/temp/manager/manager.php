<div class="main-wrapper">

    <?php include "views/temp/header.php"; ?>
    <?php include "views/temp/navbar.php"; ?>



    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Manager</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">Manager</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="student-group-form" style="margin-bottom: 2%;">
                <form method="GET" action="manager/loadClassStudent">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <select class="form-select" aria-label="Default select example" id="faculity"
                                name="faculity">
                                <option selected>Choose Faculity</option>
                                <?php
                               foreach ($data['faculity'] as $key => $value) {
                               ?>

                                <option value="<?php echo $value->id; ?>"><?php echo $value->faculity_name; ?></option>

                                <?php
                               }
                               ?>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <select class="form-select" aria-label="Default select example" id="major" name="major">


                            </select>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <select class="form-select" aria-label="Default select example" id="class" name="class">


                            </select>
                        </div>
                        <div class="col-lg-1 col-md-6"></div>
                        <div class="col-lg-2" style="    display: flex;
    justify-content: space-around;">
                            <div class="search-student-btn">
                                <input type="submit" class="btn btn-primary" value="Search">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table comman-shadow">
                        <div class="card-body">

                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title">School</h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                        <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i>
                                            Download</a>

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
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Class</th>
                                            <th>Date Of Birth</th>
                                            <th>Major Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($data['arr'])){
                                            foreach($data['arr'] as $key => $value){
                                                ?>
                                        <tr>
                                            <td>
                                                <div class="form-check check-tables">
                                                    <input class="form-check-input" type="checkbox" value="something">
                                                </div>
                                            </td>
                                            <td><?php echo $value->student_id; ?></td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="" class="avatar avatar-sm me-2"><img
                                                            class="avatar-img rounded-circle"
                                                            src="public/master/assets/img/thumbnail.png"
                                                            alt="User Image"></a>
                                                    <a href="#"><?php echo $value->full_name; ?></a>
                                                </h2>
                                            </td>
                                            <td><?php echo $value->class_name; ?></td>
                                            <td><?php echo $value->date_of_birth; ?></td>
                                            <td><?php echo $value->major_name; ?></td>
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
    $('#faculity').change(function() {
        var id = $('#faculity').val();
        $('#major').html("")
        $.ajax({
            url: "Manager/ajaxFaculity",
            type: "GET",
            data: {
                id: id
            },
            success: function(data) {
                $('#major').html(data)
            }
        })
    })
    $('#major').change(function() {
        var id = $('#major').val();
        $('#class').html("")
        $.ajax({
            url: "Manager/ajaxClass",
            type: "GET",
            data: {
                id: id
            },
            success: function(data) {
                $('#class').html(data)
            }
        })
    })
})
</script>