<script src="public/master/assets/js/jquery-3.6.0.min.js"></script>
<div class="main-wrapper">
    <?php include "views/temp/header.php"; ?>
    <?php include "views/temp/navbar.php"; ?>
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Subjects</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Dashboard/subjects</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>

            <div class="student-group-form">
                <form method="GET">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Search by ID Subject..."
                                    id="id_search" name="id_search">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Search by Name Subject ..."
                                    id="name_search" name="name_search">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Search by ID Semester ..."
                                    id="class_search" name="class_search">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="search-student-btn">
                                <button type="btn" class="btn btn-primary" id="search" name="search"
                                    value="search">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-12" style="margin-bottom: 2%;">
                    <?php
                    if (isset($_GET['status'])){
                        if ($_GET['status'] == 'succ'){
                            echo '<div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Well done!</h4>
                            <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                            <hr>
                            <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
                          </div>';
                        } else {
                           echo '<div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading">Well done!</h4>
                            <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                            <hr>
                            <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
                          </div>';
                        }
                    }
                   ?>
                </div>
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
                                        <th>No.ID</th>
                                        <th>Name</th>
                                        <th>Class</th>
                                        <th>Number Of Credits</th>
                                        <th>Semester.ID</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach ($data['list'] as $key => $value) {
                                        ?>
                                    <tr>
                                        <td>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </td>
                                        <td><?php echo $value->id; ?></td>
                                        <td>
                                            <h2>
                                                <a><?php echo $value->subjects_name; ?></a>
                                            </h2>
                                        </td>
                                        <td><?php echo $value->subjects_id; ?></td>
                                        <td><?php echo $value->number_of_credits; ?></td>
                                        <td><?php echo $value->semester_id; ?></td>
                                        <td class="text-end">
                                            <div class="actions">
                                                <a href="javascript:;" class="btn btn-sm bg-success-light me-2">
                                                    <i class="feather-eye"></i>
                                                </a>
                                                <a href="subject/editSubject?id=<?php echo $value->subjects_id; ?>"
                                                    class="btn btn-sm bg-danger-light">
                                                    <i class="feather-edit"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
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
<script>

</script>