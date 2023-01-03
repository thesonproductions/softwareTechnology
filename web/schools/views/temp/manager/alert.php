<div class="main-wrapper">

    <?php include "views/temp/header.php"; ?>
    <?php include "views/temp/navbar.php"; ?>


    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Alert Study</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Dashboard / Alert</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="student-group-form">
                <form method="GET" id="semester">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <select class="form-select" aria-label="Select semester .." id="option">
                                    <option value="0" selected>Select semester ..</option>
                                   
                                    <?php
                                        if (isset($data['semester'])){
                                            foreach($data['semester'] as $key => $value){
                                                ?>
                                                <option value="<?php echo $value->id; ?>-<?php echo $value->semester_id; ?>"><?php echo $value->semester_name; ?>-<?php echo $value->school_year; ?></option>
                                    <?php
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="search-student-btn">
                                <input type="submit" class="btn btn-warning" id="search" name="search"
                                    value="Alert Study review">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">

                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title">Alert Study</h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                        <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i>
                                            Print</a>
                                        <a href="https://preschool.dreamguystech.com/template/add-expenses.html"
                                            class="btn btn-primary"><i class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table
                                    class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Faculty</th>
                                            <th>Completed Credits</th>
                                            <th>GPA</th>
                                            <th>Message</th>
                                            <th>Classification</th>
                                        </tr>
                                    </thead>
                                    <tbody id="body">
                                      
                                        <!-- <tr>
                                            <td>PRE2209</td>
                                            <td>
                                                <h2>
                                                    <a>John</a>
                                                </h2>
                                            </td>
                                            <td>Computer Science</td>
                                            <td>50</td>
                                            <td>2.4</td>
                                            <td>17 Aug 2020</td>
                                            <td>Low</td>
                                        </tr> -->
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
    $(document).ready(function(){
        $('#semester').on('submit',function(e){
            e.preventDefault();
            var id = $('#option').val()

           if (id != 0){
            $.ajax({
                url:"manager/reviewAlert",
                type:"GET",
                data:{id:id},
                success:function(data){
                    $('#body').html(data)
                }
            })
           }
        })
    })
</script>