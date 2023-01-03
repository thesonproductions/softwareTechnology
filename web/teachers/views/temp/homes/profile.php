<div class="main-wrapper">

    <?php include "views/temp/header.php"; ?>

    <?php include "views/temp/navbar.php"; ?>

    <div class="page-wrapper" style="min-height: 284px;">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Profile</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="teacher-dashboard.html">Teacher / Profile</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="profile-header">
                        <div class="row align-items-center">
                            <div class="col-auto profile-image">
                                <a href="#">
                                    <img class="rounded-circle" alt="User Image"
                                        src="public/master/assets/img/profiles/min.png" style="max-height:100%; max-width: 100%;">
                                </a>
                            </div>
                            <div class="col ms-md-n2 profile-user-info">
                                <h4 class="user-name mb-0">Vu Tuan Anh</h4>
                                <h6 class="text-muted">professor</h6>
                                <div class="user-Location"><i class="fas fa-map-marker-alt"></i> Florida, United States
                                </div>
                                <div class="about-text">Lorem ipsum dolor sit amet.</div>
                            </div>
                            <div class="col-auto profile-btn">
                                <a href="#" class="btn btn-primary">
                                    Edit
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="profile-menu">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#per_details_tab">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#password_tab">Password</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content profile-tab-cont">

                        <div class="tab-pane fade show active" id="per_details_tab">

                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title d-flex justify-content-between">
                                                <span>Personal Details</span>
                                                <a class="edit-link" data-bs-toggle="modal" href="edit-teacher.html"><i
                                                        class="far fa-edit me-1"></i>Edit</a>
                                            </h5>
                                            <div class="row">
                                                <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Name</p>
                                                <p class="col-sm-9">John Doe</p>
                                            </div>
                                            <div class="row">
                                                <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Date of Birth
                                                </p>
                                                <p class="col-sm-9">24 Jul 1983</p>
                                            </div>
                                            <div class="row">
                                                <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">ID</p>
                                                <p class="col-sm-9">20005986</p>
                                            </div>
                                            <div class="row">
                                                <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Email ID</p>
                                                <p class="col-sm-9">johndoe@example.com</p>
                                            </div>
                                            <div class="row">
                                                <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Mobile</p>
                                                <p class="col-sm-9">305-310-5857</p>
                                            </div>
                                            <div class="row">
                                                <p class="col-sm-3 text-muted text-sm-end mb-0">Address</p>
                                                <p class="col-sm-9 mb-0">4663 Agriculture Lane,<br>
                                                    Miami,<br>
                                                    Florida - 33165,<br>
                                                    United States.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">

                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title d-flex justify-content-between">
                                                <span>Skills </span>
                                                <a class="edit-link" href="#"><i class="far fa-edit me-1"></i> Edit</a>
                                            </h5>
                                            <div class="skill-tags">
                                                <span>Html5</span>
                                                <span>CSS3</span>
                                                <span>WordPress</span>
                                                <span>Javascript</span>
                                                <span>Android</span>
                                                <span>iOS</span>
                                                <span>Angular</span>
                                                <span>PHP</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>


                        <div id="password_tab" class="tab-pane fade">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Change Password</h5>
                                    <div class="row">
                                        <div class="col-md-10 col-lg-6">
                                            <form>
                                                <div class="form-group">
                                                    <label>Old Password</label>
                                                    <input type="password" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>New Password</label>
                                                    <input type="password" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Confirm Password</label>
                                                    <input type="password" class="form-control">
                                                </div>
                                                <button class="btn btn-primary" type="submit">Save Changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>