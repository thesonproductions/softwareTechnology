<div class="page-wrapper">
            <div class="content container-fluid">
                <?php
                $arr = $data['user'];
                ?>
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Edit Subject</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="">Subject / Edit Subject</a>
                                </li>
                               
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form id="submitEdit">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="form-title"><span>Subject Information</span></h5>
                                        </div>
                                        <div class="col-12 col-sm-3">
                                            <div class="form-group local-forms">
                                                <label>Subject ID <span class="login-danger">*</span></label>
                                                <input type="text" class="form-control" value="<?php echo $arr->subjects_id; ?>" id="subjects_id">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-3">
                                            <div class="form-group local-forms">
                                                <label>Subject Name <span class="login-danger">*</span></label>
                                                <input type="text" class="form-control" value="<?php echo $arr->subjects_name; ?>" id="subjects_name">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-3">
                                            <div class="form-group local-forms">
                                                <label>Number of credits <span class="login-danger">*</span></label>
                                                <input type="text" class="form-control" value="<?php echo $arr->number_of_credits; ?>" id="number_of_credit">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-3">
                                            <div class="form-group local-forms">
                                                <label>Semester ID <span class="login-danger">*</span></label>
                                                <input type="text" class="form-control" value="<?php echo $arr->semester_id; ?>" id="semester_id">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="student-submit">
                                                <input type="submit" class="btn btn-primary" value="Submit">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="public/master/assets/js/jquery-3.6.0.min.js"></script>
<script src="vendors/swal/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function(){
        $('#submitEdit').on('submit',function(e){
            e.preventDefault()
            var subjects_id = $('#subjects_id').val()
            var subjects_name = $('#subjects_name').val()
            var semester_id = $('#semester_id').val()
            var number_of_credit = $('#number_of_credit').val()
            var data = {subjects_id:subjects_id,subjects_name:subjects_name,number_of_credit:number_of_credit,semester_id:semester_id}

            $.ajax({
                url:"subject/editNewSubject",
                type:"GET",
                dataType:"JSON",
                data: data,
                success:function(response){
                    if (response.status === 1){
                        Swal.fire(
                        'SuccessFul!',
                        'All Subject has been create',
                        'success'
                    ).then(function() {
                        window.location = "subject/index"
                    })
                    } else {
                        Swal.fire(
                        'Error!',
                        'All Subject has been create',
                        'error'
                    )
                    }
                }
            })
        })
    })
</script>
