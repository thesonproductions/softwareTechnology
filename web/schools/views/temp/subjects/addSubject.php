<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data" action="subject/import" id="addForm">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Import CSV:</label>
                                <input class="form-control" id="addBtn" type="file" name="file" >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                    id="close-add">Close</button>
                                <input type="submit" class="btn btn-primary" value="Submit">
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Add Subject</h3>
                    <button class="btn btn-outline-primary me-2" style="margin-left:2%;" data-toggle="modal"
                        data-target="#addModal"><i class="fa-solid fa-file-import"></i>
                        Import CSV </button>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Subject / Add Subject</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
      
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" id="addsubject">
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title"><span>Subject Information</span></h5>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Subject Name <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control" id="subject_name" name="subject_name"
                                            required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Subject ID <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control" id="subject_id" name="subject_id"
                                            required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Number Of Credits <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control" id="number_of_credit"
                                            name="number_of_credit" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="student-submit">
                                        <input type="submit" class="btn btn-primary" value="Submit" id="btn_submit">
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

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
    integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
    integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous">
</script>
<script src="public/master/assets/js/jquery-3.6.0.min.js"></script>
<script src="vendors/swal/sweetalert2.all.min.js"></script>
<script>
$(document).ready(function() {
    $("#close-add").click(function() {
        $("#addForm")[0].reset()
    })
    $('#addModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('.modal-body input').val(recipient)
    })
    $('#addsubject').on('submit', function(e) {
        e.preventDefault()
        var subject_name = $('#subject_name').val()
        var subject_id = $("#subject_id").val()
        var number_of_credit = $('#number_of_credit').val()

        var data = {
            subject_name: subject_name,
            subject_id: subject_id,
            number_of_credit: number_of_credit
        }

        $.ajax({
            url: "subject/addNewSubject",
            type: "GET",
            dataType: "JSON",
            data: data,
            success: function(response) {
                if (response.status === 1) {
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