<div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <?php include_once "views/temp/header.php"; ?>
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <?php include_once "views/temp/navbar.php"; ?>
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Account Manager</h4>
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
                <div class="card">
                    <div class="card-body wizard-content">
                        <h4 class="card-title">Add Account Admin</h4>
                        <h6 class="card-subtitle"></h6>
                        <form id="example-form" action="#" class="m-t-40">
                            <div>
                                <h3>Account</h3>
                                <section>
                                    <label for="userName">User name *</label>
                                    <input id="userName" name="userName" type="text" class="required form-control">
                                    <label for="password">Password *</label>
                                    <input id="password" name="password" type="text" class="required form-control">
                                    <label for="confirm">Confirm Password *</label>
                                    <input id="confirm" name="confirm" type="text" class="required form-control">
                                    <p>(*) Mandatory</p>
                                </section>
                                <h3>Profile</h3>
                                <section>
                                    <label for="name">Full name *</label>
                                    <input id="name" name="fullname" type="text" class="required form-control">
                                    <label for="address">Address</label>
                                    <input id="address" name="address" type="text" class=" form-control">
                                    <p>(*) Mandatory</p>
                                </section>
                                <h3>Finish</h3>
                                <section>
                                    <input id="acceptTerms" name="acceptTerms" type="checkbox" class="required">
                                    <label for="acceptTerms">I agree with the Terms and Conditions.</label>
                                </section>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12">
                                        <input type="submit" class="form-control btn btn-success" value="Submit">
                                    </div>
                                </div>
                            </div>
                        </form>
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
                All Rights Reserved by Matrix-admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->