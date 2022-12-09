<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from preschool.dreamguystech.com/template/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Nov 2022 14:37:29 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Login</title>

    <link rel="shortcut icon" href="https://preschool.dreamguystech.com/template/assets/img/favicon.png">

    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&amp;display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="public/master//assets/plugins/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="public/master/assets/plugins/feather/feather.css">

    <link rel="stylesheet" href="public/master/assets/plugins/icons/flags/flags.css">

    <link rel="stylesheet" href="public/master/assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="public/master/assets/plugins/fontawesome/css/all.css">

    <link rel="stylesheet" href="public/master/assets/css/style.css">
</head>

<body>

    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">
                <div class="loginbox">
                    <div class="login-left">
                        <img class="img-fluid" src="https://preschool.dreamguystech.com/template/assets/img/login.png"
                            alt="Logo">
                    </div>
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Welcome to Preskool</h1>
                            <p class="account-subtitle">Need an account? <a
                                    href="https://preschool.dreamguystech.com/template/register.html">Sign Up</a></p>
                            <h2>Sign in</h2>

                            <form method="POST" id="form_login">
                                <div class="form-group">
                                    <label>Username <span class="login-danger">*</span></label>
                                    <input class="form-control" type="text" id="username" name = "username">
                                    <span class="profile-views"><i class="fas fa-user-circle"></i></span>
                                </div>
                                <div class="form-group">
                                    <label>Password <span class="login-danger">*</span></label>
                                    <input class="form-control pass-input" type="password" id="password" name = "password">
                                    <span class="profile-views feather-eye toggle-password"></span>
                                </div>
                                <div class="forgotpass">
                                    <div class="remember-me">
                                        <label class="custom_check mr-2 mb-0 d-inline-flex remember-me"> Remember me
                                            <input type="checkbox" name="radio">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <a href="https://preschool.dreamguystech.com/template/forgot-password.html">Forgot
                                        Password?</a>
                                </div>
                                <div class="form-group">
                                    <div id="form_error">
                                   
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary btn-block" type="submit" value="login" id="btn_login">
                                </div>
                            </form>

                            <div class="login-or">
                                <span class="or-line"></span>
                                <span class="span-or">or</span>
                            </div>

                            <div class="social-login">
                                <a href="#"><i class="fab fa-google-plus-g"></i></a>
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="public/master/assets/js/jquery-3.6.0.min.js"></script>

    <script src="public/master/assets/plugins/bootstrap/js/bootstrap.bundle.min.js">
    </script>

    <script src="public/master/template/assets/js/feather.min.js"></script>

    <script src="public/master/template/assets/js/script.js"></script>
</body>
<script>
    $(document).ready(function(){
       
        $("#form_login").on("submit",function(e){
            var username = $("#username").val()
            var password = $("#password").val()

            flag = checkValid(username,password)
     
            e.preventDefault();
            var dataV = {username: username, password: password}
            if (flag){
                $.ajax({
                    type :"POST",
                    url: 'Login/formLogin',
                    data : dataV,
                    cache:false,
                    dataType: 'json',
                    beforeSend:function(){
                        $('#btn_login').attr('disabled', 'disabled');
                    }, success: function(response){
                        
                    }
                })
            }
        })
       
    })
    function checkValid(username, password){
        if (validEmail(username) === false){
            $('#form_error').css('display','block')
            $('#form_error').css('color','red')
            $('#form_error').html('<p>' + 'invalid Username! please try again.' + '</p>')
            return false
        }
        else if (validPassword(password) === false){
            $('#form_error').css('display','block')
            $('#form_error').css('color','red')
            $('#form_error').html('<p>' + 'invalid password! please try again.' + '</p>')
            return false
        }
        return true
    }
    function validEmail(username) {
        var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-z\-0-9]+\.)+[a-z]{2,}))$/;
        return re.test(username);
    }
    function validPassword(password) {
        const isStrongPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*]).{8,}$/;
        return isStrongPassword.test(password)
    }
</script>
<!-- Mirrored from preschool.dreamguystech.com/template/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Nov 2022 14:37:29 GMT -->

</html>