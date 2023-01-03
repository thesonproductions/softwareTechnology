<script src="public/master/assets/js/jquery-3.6.0.min.js"></script>
<div class="main-wrapper">

    <?php include "views/temp/header.php"; ?>
    <?php include "views/temp/navbar.php"; ?>

    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Edit Score</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Teacher / Edit Score</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">
                            <form id="editScore" method="POST" action="score/updateScore">
                                <input type="hidden" value="<?php echo $_GET['student_id'] ?>-<?php echo $_GET['subject_id'] ?>" id="idstc" name="idstc">
                                <div class="row">
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Process Score (*)</label>
                                            <input class="form-control" type="text" value="<?php if ($data['score']->point_process) {
                                                echo $data['score']->point_process;} ?>" id="process" name="process" min="0" max="10">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Mid Score (*)</label>
                                            <input class="form-control" type="text" value="<?php if ($data['score']->midterm_score	) {
                                                echo $data['score']->midterm_score;} ?>" id="mid" name="mid" min="0" max="10">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>End Score (*)</label>
                                            <input class="form-control" type="text" value="<?php if ($data['score']->end_point) {
                                                echo $data['score']->end_point;} ?>" id="end" name="end" min="0" max="10">
                                        </div>
                                    </div>
                                    <div class="col-12" style="display: flex;">
                                        <div class="student-submit">
                                            <input type="submit" class="btn btn-primary" value="Submit">
                                        </div>
                                        <div class="student-submit" style="margin-left: 2%;">
                                            <button type="button" class="btn btn-success" id="activeBtn">Active</button>
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
<script>
    $('#activeBtn').click(function(){
        var id = $('#idstc').val()
        id = id.split('-')
        var data = {student_id: id[0], subject_id: id[1]}
        $.ajax({
            url: "score/activeScore",
            type:"POST",
            data:data,
            dataType:"JSON",
            success:function(response){
                if (response.status === 1){
                    $('#activeBtn').attr('disabled', 'disabled')
                    window.location="score/index"
                }
            }
        })
    })
</script>