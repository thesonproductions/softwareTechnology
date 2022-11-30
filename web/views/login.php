<?php require_once "./core/config.php"; ?>

<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- base url link -->
    <base href="<?php echo BASE_URLS; ?>">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="public/master/assets/images/favicon.png">
    <title>Cổng thông tin và đạo tạo</title>
    <!-- Custom CSS -->
    <link href="public/master/dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
            <div class="auth-box bg-dark border-top border-secondary">
                <div id="loginform">
                    <div class="text-center p-t-20 p-b-20">
                        <span class="db"><img src="public/master/assets/images/logo2.png" alt="logo" /></span>
                    </div>
                    <!-- Form -->
                    <form class="form-horizontal m-t-20" id="loginform" method="POST">
                        <div class="row p-b-30" style="padding: 0;">
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i
                                                class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg"
                                        placeholder="Please enter Username" aria-label="Username"
                                        aria-describedby="basic-addon1" required="" id="username" name="username">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i
                                                class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" placeholder="Password"
                                        aria-label="Password" aria-describedby="basic-addon1" required="" id="password"
                                        name="password">
                                </div>
                            </div>
                            <div class="status-error">
                               
                            </div>
                        </div>

                        <div class="row border-top border-secondary">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="p-t-20" style="display: flex;justify-content: space-between;">
                                        <button class="btn btn-info" id="to-recover" type="button"><i
                                                class="fa fa-lock m-r-5"></i> Lost password?</button>
                                        <!-- <button class="btn btn-success float-right" type="submit">Login</button> -->
                                        <input type="submit" class="btn btn-success" id="btn-submit">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div id="recoverform">
                    <div class="text-center">
                        <span class="text-white">Enter your e-mail address below and we will send you instructions how
                            to recover a password.</span>
                    </div>
                    <div class="row m-t-20">
                        <!-- Form -->
                        <form class="col-12" action="index.html">
                            <!-- email -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-danger text-white" id="basic-addon1"><i
                                            class="ti-email"></i></span>
                                </div>
                                <input type="text" class="form-control form-control-lg" placeholder="Email Address"
                                    aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <!-- pwd -->
                            <div class="row m-t-20 p-t-20 border-top border-secondary">
                                <div class="col-12">
                                    <a class="btn btn-success" href="#" id="to-login" name="action">Back To Login</a>
                                    <button class="btn btn-info float-right" type="button"
                                        name="action">Recover</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="public/master/assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="public/master/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="public/master/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    // ============================================================== 
    // Login and Recover Password 
    // ============================================================== 
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
    $('#to-login').click(function() {

        $("#recoverform").hide();
        $("#loginform").fadeIn();
    });

    $(document).ready(function() {
        $("#loginform").on('submit', function(e) {
            e.preventDefault()
            var username = $("#username").val()
            var password = $("#password").val()
            console.log({
                username: username,
                password: password
            })
            if (validForm()) {
                $.ajax({
                    type: "POST",
                    url: "Login/",
                    data: {
                        username: username,
                        password: password
                    },
                    cache: false,
                    dataType: 'json',
                    beforeSend: function() {
                        $('#btn-submit').attr('disabled', 'disabled');
                    },
                    success: function(response) {

                    }
                })
            }
        })

        function validForm() {
            var username = $('#username').val()
            var password = $('#password').val()

            if (validPassword(password) === false) {
                $('.status-error').css('display','block')
                $('.status-error').css('color','red')
                $('.status-error').html('<p class="">' + 'invalid password or email ! please try again.' + '</p>')
                return false
            } else if (validEmail(username) === false) {
                $('.status-error').css('display','block')
                $('.status-error').css('color','red')
                $('.status-error').html('<p class="">' + 'invalid password or email ! please try again.' + '</p>')
                return false
            }
            return true
        }

        function validEmail(email) {
            var re =
                /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
            return re.test(email);
        }


        function validPassword(password) {
            const isStrongPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*]).{8,}$/;
            return isStrongPassword.test(password)
        }

    })
    </script>
</body>

</html>