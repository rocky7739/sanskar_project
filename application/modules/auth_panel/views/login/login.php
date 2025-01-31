<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//echo $AUTH_PANEL_URL; 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Mosaddek">
        <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
        <link rel="shortcut icon" href="<?= base_url('assets/website_assets/images/favicon.ico') ?>">

        <title><?= CONFIG_PROJECT_FULL_NAME ?> ADMIN LOGIN</title> 

        <!-- Bootstrap core CSS auth_panel_assets -->
        <link href="<?php echo base_url(); ?>auth_panel_assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>auth_panel_assets/css/bootstrap-reset.css" rel="stylesheet">
        <!--external css-->
        <link href="<?php echo base_url(); ?>auth_panel_assets/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom styles for this template -->
        <link href="<?php echo base_url(); ?>auth_panel_assets/css/style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>auth_panel_assets/css/style-responsive.css" rel="stylesheet" />
        <style>
/*                body {
                    background: url(<?php echo base_url(); ?>auth_panel_assets/img/landing-users.png) ;
                    webkit-animation: sidedownscroll 30s linear infinite;
                    animation: sidedownscroll 30s linear infinite;
                  }*/
/*            body{
                background: url(<?php echo base_url(); ?>auth_panel_assets/img/landing-users.png) repeat 0 0;
                -webkit-animation: 30s linear 0s normal none infinite animate;
                -moz-animation: 30s linear 0s normal none infinite animate;
                -ms-animation: 30s linear 0s normal none infinite animate;
                -o-animation: 30s linear 0s normal none infinite animate;
                animation: 30s linear 0s normal none infinite animate;

            }  */

            @-webkit-keyframes animate {
                from {background-position:0 0;}
                to {background-position: 1000px 0;}
            }

            @-moz-keyframes animate {
                from {background-position:0 0;}
                to {background-position: 1000px 0;}
            }

            @-ms-keyframes animate {
                from {background-position:0 0;}
                to {background-position: 1000px 0;}
            }

            @-o-keyframes animate {
                from {background-position:0 0;}
                to {background-position: 1000px 0;}
            }

            @keyframes animate {
                from {background-position:0 0;}
                to {background-position: 1000px 0;}
            }

            p.wrong {
                display: none;
            }

            p.wrong.shake {
                display: block;
            }

            p.wrong.shake {
                animation: shake .4s cubic-bezier(.36, .07, .19, .97) both;
                transform: translate3d(0, 0, 0);
                backface-visibility: hidden;
                perspective: 1000px;
            }

            @keyframes shake {
                10%, 90% {
                    transform: translate3d(-1px, 0, 0);
                }
                20%, 80% {
                    transform: translate3d(1px, 0, 0);
                }
                30%, 50%, 70% {
                    transform: translate3d(-2px, 0, 0);
                }
                40%, 60% {
                    transform: translate3d(2px, 0, 0);
                }
            }

            .controls img {
                height: 20px;
            }
            .refresh{
                margin-top: 52px;
            }
        </style>
        <script>
            let captcha_string = "<?= $_SESSION['captcha'] ?? "" ?>";
        </script>
    </head>

    <body class="login-body">
        <div class="container">
<!--            <form class="form-signin" method="POST" action="<?//php echo site_url('auth_panel/login/index'); ?>">-->
            <form class="form-signin" method="POST" action="<?php echo BASE_URL(INDEX_PHP.'admin-panel'); ?>">
                <h2 class="form-signin-heading bold">Sign in to <?= CONFIG_PROJECT_FULL_NAME ?></h2>
                <div class="login-wrap">
                    <span class="error bold"><?= (isset($error)) ? $error : "" ?></span>
                    <input type="text" class="form-control" value="<?php echo set_value('email') ?>" name="email" placeholder="Email" id="login_username">
                    <span class="error bold"><?php echo form_error('email'); ?></span>
                    <input type="password" class="form-control" name="password" placeholder="Password" id="login_pwd" value="<?php echo set_value('password') ?>">
                    <span class="error bold"><?php echo form_error('password'); ?></span>

                    <label class="checkbox col-md-12 captcha-chat">
                        <div id="captcha">
                            <img class="refresh btn-common" src="<?= base_url() . "auth_panel_assets/img/refresh_icon.png" ?>">
                            <input class="user-text form-control captcha" name="captcha" placeholder="Type here" type="text" />
                            <p class="wrong info">Wrong!, please try again.</p>
                            <span class="validate btn-common"></span>
                        </div>
                    </label>
                    <label class="checkbox">
                <!--<input type="checkbox" value="remember-me"> Remember me-->
                <span class="pull-right">
                    <a data-toggle="modal" href="#myModal"> Forgot Password?</a>

                </span>
            </label>
                    <button class="btn btn-lg btn-login btn-block" type="submit">Sign in</button>
                </div>

            </form>

        </div>

    <!-- ################### Forget password of admin pop up  model ################################-->

   <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 class="modal-title">Forgot Password ?</h4>
                </div>
            <div class="modal-body">
                    <span id="validate_message"></span>
                    <p>Enter your e-mail address below to reset your password.</p>
                    <input type="text" class="form-control placeholder-no-fix" autocomplete="off" placeholder="Email" name="email" id="email">

                    <div id="change_password" class="hide">

                    </div>

            </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button type="button" class="btn btn-success submit_form">Submit</button>
                </div>
            </div>
        </div>
    </div>


        <!-- js placed at the end of the document so the pages load faster -->
        <script src="<?php echo base_url(); ?>auth_panel_assets/js/jquery.js"></script>
        <script src="<?php echo base_url(); ?>auth_panel_assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>auth_panel_assets/js/captcha.js"></script>
        <script>
            $(document).ready(function () {
                $('.submit_form').click(function () {
                    var post_type = $('#post_type').val();
                    var data = '';
                    if (post_type == 'change_pwd') {
                        data = {'email': $('#email').val(), 'tokken': $('#tokken').val(), 'new_pwd': $('#new_pwd').val(), 'cnf_pwd': $('#cnf_pwd').val(), 'post_type': $('#post_type').val()};

                    } else {
                        data = {'email': $('#email').val()};
                    }

                    jQuery.ajax({
                        url: '<?php echo base_url(INDEX_PHP.'auth_panel/login/forget_password'); ?>',
                        method: 'POST',
                        dataType: 'json',
                        data: data,
                        success: function (data) {
                            if (data.status) {
                                if (data.post_type == '') {
                                    $('#validate_message').css('color', 'green');
                                    $('#validate_message').text(data.message);
                                    $('#change_password').removeClass('hide');
                                    $('#change_password').html('<p>Enter OTP</p><input autocomplete=off class="form-control placeholder-no-fix"id=tokken name=tokken placeholder="Enter OTP"><p>Enter new password</p><input autocomplete=off class="form-control placeholder-no-fix"id=new_pwd name=new_pwd placeholder="Enter New Password"><p>Enter confirm password</p><input autocomplete=off class="form-control placeholder-no-fix"id=cnf_pwd name=cnf_pwd placeholder="Enter Confirm Password"> <input autocomplete=off class="form-control placeholder-no-fix"id=post_type name=post_type placeholder=""type=hidden value=change_pwd>');
                                } else {
                                    $('#validate_message').css('color', 'green');
                                    $('#validate_message').html(data.message);
                                    $('#myModal input').val('');
                                }
                            } else {
                                $('#validate_message').css('color', 'red');
                                $('#validate_message').text(data.message);
                            }

                        }
                    });
                })
            });

            let is_captcha_success = 0;
            document.addEventListener("DOMContentLoaded", function () {
                document.body.scrollTop; //force css repaint to ensure cssom is ready

                var timeout; //global timout variable that holds reference to timer

                var captcha = new $.Captcha({
                    onFailure: function () {
                        is_captcha_success = 0;
                        $(".captcha-chat .wrong").show({
                            duration: 30,
                            done: function () {
                                var that = this;
                                clearTimeout(timeout);
                                $(this).removeClass("shake");
                                $(this).css("animation");
                                //Browser Reflow(repaint?): hacky way to ensure removal of css properties after removeclass
                                $(this).addClass("shake");
                                var time = parseFloat($(this).css("animation-duration")) * 1000;
                                timeout = setTimeout(function () {
                                    $(that).removeClass("shake");
                                }, time);
                            }
                        });

                    },

                    onSuccess: function () {
                        is_captcha_success = 1;
//                        alert("CORRECT!!!");
                    }
                });

                captcha.generate();
            });

            $(".form-signin").submit(function () {
                $(".validate").click();
                if (is_captcha_success == 0)
                    return false;
            });

            $(".refresh").click(function () {
                localStorage.setItem("email", $("#login_username").val());
                localStorage.setItem("password", $("#login_pwd").val());
                window.location.reload();
            });

            let email = localStorage.getItem("email");
            let password = localStorage.getItem("password");
            if (email != undefined && email != "") {
                $("#login_username").val(email);
            }
            if (password != undefined && password != "") {
                $("#login_pwd").val(password);
            }
            localStorage.removeItem("email");
            localStorage.removeItem("password");
        </script>
    </body>
</html>
