<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APMC Traders - Login ERP Solution for APMC Traders</title>
    <!-- password visibility (eye icon toggle) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">


    <!--link the bootstrap css file-->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- <link rel="icon" type="image/png" href="infoway_globe.png"> -->

    <!-- Favicons -->
    <link href="<?php echo base_url('images/infoway_globe.png') ?>" rel="icon">

    <!--load jQuery library-->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!--load bootstrap.js-->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <style type="text/css">
        .colbox {
            margin-left: 10px;
            margin-right: 10px;
        }

        body {
            /*         background-color: #3C599B;*/
            /* background-image:url('../images/bl1.jpg'); */
            /* background-image:url('../images/background-01.jpg'); */
            /* background-image:url('../images/his-login-background.gif');
                background-repeat:no-repeat;                 
                background-size:50% 40vh;
                background-position:top; */
        }

        label {
            color: white;
        }

        /* eye icon  */
        #togglePassword {
            margin-top: -23px;
            margin-right: 5px;
            float: right;
        }
    </style>
    <script>
        $(document).ready(function() {
            document.getElementById("txt_username").focus();
        });
    </script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 text-center">
                <!-- <h1 style="color: red"> INFOWAY's HIS-uf-ERP</h1> -->
                <!-- <h4>THE ONLY USER FRIENDLY ACCOUNTING SOLUTION FOR APMC TRADERS </h4> -->
                <a href="<?php echo base_url(); ?> ">
                    <!-- <h3 style="color: red"> APMC Traders  -->
                    </h3>
                </a>
                <!-- <h3>APMC Traders</h3> -->
            </div>
        </div>
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <!-- <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br> -->

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-4 well col-md-offset-4 text-center">
                <?php
                $attributes = array(
                    "class" => "form-horizontal",
                    "id"    => "captcha_form",
                    "name"  => "captcha_form"
                );
                echo form_open("login/index", $attributes);
                ?>
                <form class="login-form">
                    <fieldset class="loginbox" style="background-color:#06074f ; ">
                        <img src=" <?php echo base_url('images/apmc-logo.png') ?> " height="90" width="349" alt="apmctraders_logo">
                        <br>
                        <hr>
                        <div class="form-group">
                            <div class="row colbox">
                                <div class="col-lg-4 col-sm-4">
                                    <label for="txt_username" class="control-label">Username</label>
                                </div>
                                <div class="col-lg-8 col-sm-8">
                                    <input class="form-control" id="txt_username" name="txt_username" placeholder="Username" type="text" value="<?php echo set_value('txt_username'); ?>" />
                                    <span class="text-danger"><?php echo form_error('txt_username'); ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row colbox">
                                <div class="col-lg-4 col-sm-4">
                                    <label for="txt_password" class="control-label">Password</label>
                                </div>
                                <div class="col-lg-8 col-sm-8">
                                    <div class=pass-container>
                                        <input class="form-control" id="txt_password" name="txt_password" placeholder="Password" type="password" value="<?php echo set_value('txt_password'); ?>" />
                                        <i class="far fa-eye" id="togglePassword"></i>
                                    </div>
                                    <span class="text-danger"><?php echo form_error('txt_password'); ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="form-group">
                                <div class="row colbox">
                                    <div class="col-lg-4 col-sm-4">
                                        <label for="txt_clientid" class="control-label">Client Code</label>
                                    </div>
                                    <div class="col-lg-8 col-sm-8">
                                        <input class="form-control"
                                               id="txt_clientid"
                                               name="txt_clientid"
                                               placeholder="Client Code"
                                               type="text"
                                               value="<?php echo set_value('txt_clientid'); ?>" />
                                        <span class="text-danger"><?php echo form_error('txt_clientid'); ?></span>
                                    </div>
                                </div>
                            </div>
 -->
                        <div class="form-group">
                            <div class="row colbox">
                                <div class="col-lg-4 col-sm-4">
                                    <label for="not_robot" class="control-label">Captcha</label>
                                </div>
                                <div class="col-lg-8 col-sm-8">
                                    <?php
                                    if ($captcha_form) {
                                    ?>
                                        <p><?php echo $captcha_html; ?></p>
                                        <input class="form-control" id="not_robot" name="not_robot" type="text" placeholder="Type Above Captcha Here" />
                                        <span class="text-danger"><?php echo form_error('not_robot'); ?></span>
                                    <?php
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-12 col-sm-12 text-center">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input id="btn_login" name="btn_login" type="submit" class="btn btn-default" value="Login" />

                                <input id="btn_cancel" name="btn_cancel" type="reset" class="btn btn-default" value="Cancel" />
                            </div>
                        </div>
                        <!-- <div>
                            <code>
                                <a href="<?php echo base_url(); ?>index.php/login/download/">Download Android Mobile Application</a>
                            </code>
                        </div> -->
                        <br>
                    </fieldset>
                </form>
                <?php echo form_close(); ?>
                <?php echo $this->session->flashdata('msg'); ?>
            </div>
        </div>
    </div>
</body>

<script>
    //password visibility (eye icon toggle)
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#txt_password');

    togglePassword.addEventListener('click', function(e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye icon
        this.classList.toggle('fa-eye-slash');
    });
</script>

</html>