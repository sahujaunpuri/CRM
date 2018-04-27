<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <!-- Apple devices fullscreen -->
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <!-- Apple devices fullscreen -->
    <meta names="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <title>Sign in</title>
</head>
<body class='login' style="background-image: url('<?php echo ASSET_PATH.'images/bg/4.jpg' ?>')">
    <div class="login-box">
        <div class="login-body display-none margin-center login-form" style="height: 475px">
            <div class="margin-center img-logo display-none login-element" id="logo-img">
                <img src="<?php echo ASSET_PATH.'images/logo.jpeg' ?>" class='img mw100'/>    
            </div>
            <div  login-element">
                <h3 id="heading" class="display-none text-center">Sign in</h3>
            </div>
            <?php echo $this->session->flashdata('info_msg'); ?>
            <form autocomplete="off" action="#" method="post" id="login_form" class="display-none" autocomplete="off">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Username"
                        required=""/>
                    </div>
                </div>
                <div class="form-group" id="password_div">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-key"></i>
                        </div>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required=""/>
                    </div>
                </div>
                <div id="login_btn_div" class="display-none">
                    <input value="Sign me in" id="login_btn" class="margin-center btn btn-success login-submit" type="submit">
                </div>
            </form>
            <div class="forget display-none" >
                <div class="">
                    <div class="">
                        <a class="btn btn-grey w100" id="f_pass" ><span>Forgot password?</span></a>
                        <a class="btn btn-grey w100" id="login"><span>Login</span></a>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="text-center display-none" id="managed">
                Proudly Managed By TRUELINE INFOTECH<br>
                &copy; <?php echo date("Y"); ?>
            </div>
        </div>

        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
    <!-- Bootstrap -->
    <link href="<?php echo CSS_PATH . 'bootstrap/css/bootstrap.min.css'; ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo CSS_PATH . 'font-awesome/css/font-awesome.min.css'; ?>" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap responsive -->
    <link rel="stylesheet" href="<?php echo CSS_PATH . 'bootstrap-responsive.min.css'; ?>">
    <!-- Theme CSS -->
    <link rel="stylesheet" href="<?php echo CSS_PATH . 'style.css'; ?>">
    <link rel="stylesheet" href="<?php echo CSS_PATH . 'custom.css'; ?>">
    <!-- Color CSS -->
    <link rel="stylesheet" href="<?php echo CSS_PATH . 'themes.css'; ?>">
    <link rel="stylesheet" href="<?php echo CSS_PATH . 'datepicker\css\datepicker.css'; ?>">
    <!-- jQuery -->
    <script type="text/javascript" src="<?php echo JS_PATH . 'jQuery-2.1.4.min.js'; ?>"></script>
    <link rel="stylesheet" href="<?php echo CSS_PATH . 'toastr.min.css'; ?>">

<!--[if lte IE 9]>
<script src="js/plugins/placeholder/jquery.placeholder.min.js"></script>
<script>
    $(document).ready(function () {
        $('input, textarea').placeholder();
    });
</script>
<![endif]-->
<!-- Favicon -->
<link rel="shortcut icon" href="images/favicon.ico"/>
<!-- Apple devices Homescreen icon -->
<link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-precomposed.png"/>
<!-- Bootstrap 3.3.2 JS -->

<!-- Validation -->
<script type="text/javascript" src="<?php echo JS_PATH . 'bootstrap.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo JS_PATH . 'jquery.form.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo JS_PATH . 'jquery.validate.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo JS_PATH . 'bootstrap-datepicker.js'; ?>"></script>
<script type="text/javascript" src="<?php echo JS_PATH . 'toastr.min.js'; ?>"></script>


<script type="text/javascript" src="<?php echo JS_PATH . 'custom.js'; ?>"></script>
<!-- <script src="<?php //echo base_url('assets/js/plugins/validation/additional-methods.min.js');?>"></script> -->
<!-- Bootstrap -->
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.backstretch.js'); ?>"></script>

<?php
$imagepath = IMG_PATH . 'bg/';
?>

<script type="text/javascript">
    $(document).ready(function () {

        var message = "<?php echo $this->session->flashdata('message'); ?>";
        if (message != "") {
            toastr["info"](message, "Message");
        }
        var img_url = "<?php echo IMG_PATH . 'loader_3.gif' ?>";
        $("#error,#login").hide();
        var options = {
            url: "<?php echo base_url('common/login_check') ?>",
            beforeSubmit: function () {
                $(".submit").html("<div class='pull-right'><img src='" + img_url + "'></div>");

            },
            success: function (data) {
                data = $.trim(data);
                if (data == "Fail") {
                    $(".submit").html("<input type='submit'  value='Sign me in' class='btn btn-primary'>");
                    toastr["error"]("Check your Credentials", "Login Failed");
                }
                else {
                    window.location.href = "<?php echo base_url('dashboard') ?>";
                }
            },
        };

        function sleep(ms) {
          return new Promise(resolve => setTimeout(resolve, ms));
      }

      async function demo() {
        $('.login-body').fadeIn(700);    
        await sleep(400);
        $('#logo-img').fadeIn(700);    
        await sleep(200);
        $('#heading').fadeIn(700);
        await sleep(200);
        $('#login_form').fadeIn(700);
        await sleep(200);
        $('#login_btn_div').fadeIn(700);
        $('.forget').fadeIn(700);
        await sleep(200);
        $('#managed').fadeIn(700);
                
    }
    demo();
    var forgot_options = {
        url: "<?php echo base_url('common/forgot_password') ?>",
        resetForm: true,
        beforeSubmit: function () {
            $("#login_btn").html("<i class='fa fa-spin fa-refresh fa-pulse'></i>");
        },
        success: function (data) {
            $(".submit").html("<input type='submit'  value='Sign me in' class='btn btn-primary'>");
            toastr["warning"](data, "Message");
        },
    };
        // bind form using 'ajaxForm'
        $("#login_btn").click(function (event) {
            var form_id = $("form").attr('id');
            if (form_id == "login_form") {
                $('#login_form').ajaxForm(options);
            }
            if (form_id == "forgot_password_form") {
                $('#forgot_password_form').ajaxForm(forgot_options);
            }
        });
        // bind form using 'ajaxForm'
        $("#f_pass").click(function (event) {
            $("#password_div").slideUp();
            $("#username").attr('placeholder', 'Enter Your Registered Email ');
            $("#username").attr('type', 'email');
            $("#login").show();
            $("#f_pass").hide();
            $("form").attr('id', 'forgot_password_form');
            $("#login_btn").val("Submit");
        });
        $("#login").click(function (event) {
            $("#password_div").slideDown();
            $("#username").attr('placeholder', 'Username');
            $("#username").attr('type', 'text');
            $("#f_pass").show();
            $("#login").hide();
            $("form").attr('id', 'login_form');
            $("#login_btn").val("Sign me in");
        });
    });
</script>

</body>
</html>

