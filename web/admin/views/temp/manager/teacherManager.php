<div id="main-wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <?php include_once "views/temp/header.php"; ?>
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <?php include_once "views/temp/navbar.php"; ?>
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Teacher Manager Account</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Library</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-4" style="margin-bottom: 2%;">
                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addUser"
                        data-whatever="@mdo"><i class="mdi mdi-account-plus"></i></button>
                    <button type="button" class="btn btn-success btn-lg" data-toggle="modal"
                        data-target="#addUserfromCsv" data-whatever="@mdo"><i class="mdi mdi-attachment"></i></button>
                    <a href="Manager/exportMember?level=2"><button type="button" class="btn btn-warning btn-lg"
                            data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><i
                                class="mdi mdi-export"></i></button></a>
                    <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal"
                        data-target="#exampleModal" data-whatever="@mdo"><i
                            class="mdi mdi-printer-settings"></i></button>
                </div>
                <div class="col-6"></div>
                <div class="col-2">
                    <a id="createAccount"><button type="button" class="btn btn-warning"> <i class="mdi mdi-border-inside"></i> Create All Accounts</button></a>
                </div>
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
            <div class="modal fade show" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true" aria-modal="true" style="transition: all 0.6s ease;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="addUser" method="POST">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Full Name</label>
                                    <input type="text" class="form-control" id="fullname" name="fullname">
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Date of birth</label>
                                    <input type="date" class="form-control" id="dob" name="dob">
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Phone.Num</label>
                                    <input type="text" class="form-control" id="phonenum" name="phonenum">
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-primary" id="btn-submit-add" value="Submit">
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal fade show" id="addUserfromCsv" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true" aria-modal="true"
                style="transition: all 0.6s ease;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Import CSV File</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" enctype="multipart/form-data" action="Manager/importMember?level=2">
                                <div class="form-group">
                                    <label for="addBtn" class="col-form-label">Import File:</label>
                                    <input class="form-control" id="addBtn" type="file" name="file" name="addBtn">
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                        id="close-add">Close</button>
                                    <input type="submit" class="btn btn-primary" value="Import">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Student Datatable</h5>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID.No</th>
                                            <th>Full Name</th>
                                            <th>Date of birth</th>
                                            <th>Phone.Num</th>
                                            <th>Address</th>
                                            <!-- <th>Notionality</th> -->
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $listStd = $data['listStd'];
                                        foreach ($listStd as $key => $value) {
                                        ?>
                                        <tr>
                                            <th><?php echo $value->id; ?></th>
                                            <th><?php echo $value->full_name; ?></th>
                                            <th><?php echo $value->date_of_birth; ?></th>
                                            <th><?php echo $value->phone_number; ?></th>
                                            <th><?php echo $value->address; ?></th>
                                            <th>
                                                <a href="Manager/modifyMember?id=<?php echo $value->id; ?>&level=<?php echo 2; ?>" ><button type="button" class="<?php if (!empty($data['model']->readAccount($value->id,2))){
                                                    if ($data['model']->readAccount($value->id,2)->status == 1){
                                                    echo "btn btn-warning";
                                                    } else {
                                                        echo "btn btn-success"; 
                                                    }
                                                } else {
                                                echo "btn btn-primary";
                                                } ?>"><i class="<?php if (!empty($data['model']->readAccount($value->id,2))){
                                                    if ($data['model']->readAccount($value->id,2)->status == 1){
                                                    echo "mdi mdi-lock";
                                                    } else {
                                                        echo "mdi mdi-lock-open-outline"; 
                                                    }
                                                } else {
                                                echo "mdi mdi-link";
                                                } ?>"></i></button></a>
                                                <a href="Manager/removeMember?id=<?php echo $value->id; ?>&level=<?php echo 2; ?>" ><button type="button" class="btn btn-danger"><i class="mdi mdi-window-close"></i></button></a>
                                            </th>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID.No</th>
                                            <th>Full Name</th>
                                            <th>Date of birth</th>
                                            <th>Phone.Num</th>
                                            <th>Address</th>
                                            <th></th>
                                            <!-- <th>Notionality</th> -->
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Right sidebar -->
            <!-- ============================================================== -->
            <!-- .right-sidebar -->
            <!-- ============================================================== -->
            <!-- End Right sidebar -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer text-center">
            All Rights Reserved by Matrix-admin. Designed and Developed by <a
                href="https://wrappixel.com">WrapPixel</a>.
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
</div>
</div>
<script src="public/master/assets/libs/jquery/dist/jquery.min.js"></script>
<script src="vendors/swal/sweetalert2.all.min.js"></script>
<script>
$(document).ready(function() {
    $("#addUser").on("submit", function(e) {
        e.preventDefault()
        var fullname = $("#fullname").val()
        var dob = $("#dob").val()
        var phonenum = $("#phonenum").val()
        var address = $("#address").val()
        var data = {
            fullname: fullname,
            dob: dob,
            phonenum: phonenum,
            address: address,
            level: 2
        }
        console.log(data)
        $.ajax({
            url: "Manager/addMember",
            type: "POST",
            dataType: "JSON",
            data: data,
            success: function(response) {
                if (response.status === 1) {
                    window.location = "Manager/teacher"
                }
            }
        })
    })
    $("#createAccount").click(function(e){
        e.preventDefault()
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Agree to Create!'
        }).then((result) => {
        if (result.isConfirmed) {
            var level = 2
            $.ajax({
                url: "Manager/craeteAllAccount",
                type: "GET",
                dataType: "JSON",
                data: {level: level},
                success:function(response){
                    if (response.status === 1){
                        Swal.fire(
                        'SuccessFul!',
                        'All account has been create',
                        'success'
                        ).then(function(){
                            location.reload()
                        })
                    } else {
                        Swal.fire(
                        'Error!',
                        'All account has  been not create',
                        'error'
                        )
                    }
                }
            })
        } 
    })
        
    })
    $("#close-add").click(function() {
        $("#addUser")[0].reset()
    })
})
</script>