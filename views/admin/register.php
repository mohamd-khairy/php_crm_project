<!DOCTYPE html>
<?php
if (isset($msg) || isset($error)) {
    if ($msg == 1) {
        ?>
        <div class="box-body">
            <div class="alert alert-success h5" role="alert">تمت العمليه بنجاح...</div>

        </div>
    <?php } else if ($msg == -1) { ?>
        <div class="box-body">
            <div class="alert alert-danger h4" role="alert"><strong>خطأ!</strong>..يوجد شئ غير صحيح.. <?php
                if (isset($error)) {
                    echo $error;
                }
                ?></div>

        </div>           
    <?php } else if ($msg == -2) {
        ?>
        <div class="box-body">
            <div class="alert alert-danger h4" role="alert"><strong>خطأ!</strong>..هذا اايميل موجود بالفعل..!! </div>

        </div> 
        <?php
    } else if ($msg == -4) {
        ?>
        <div class="box-body">
            <div class="alert alert-danger h4" role="alert"><strong>خطأ!</strong>..هذا التليفون موجود بالفعل..!! </div>

        </div> 
        <?php
    }
}
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>صفحه التسجيل | أدمن علم</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="../../plugins/iCheck/square/blue.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition register-page">
        <div class="register-box">
            <div class="register-logo">
                <a href="../../index2.html"><b>علم</b>أدمن</a>
            </div>

            <div class="register-box-body">
                <p class="login-box-msg">تسجيل حساب جديد</p>

                <form  method="post" enctype="multipart/form-data">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="acc_name" placeholder="الاسم">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="email" class="form-control"  name="acc_email"placeholder="الايميل">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control"name="acc_password" placeholder="كلمه السر">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="tel" class="form-control" name="acc_phone" placeholder="الموبيل">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="acc_city" placeholder="البلد">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="file" class="form-control" name="acc_image" >
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <input type="hidden" class="form-control" name="role" value="manager" >

                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">تسجيل</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>


                <a href="?rt=HomePage/login" class="text-center">أنا بالفعل عضو </a>
            </div>
            <!-- /.form-box -->
        </div>
        <!-- /.register-box -->

        <!-- jQuery 2.2.3 -->
        <script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="../../bootstrap/js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="../../plugins/iCheck/icheck.min.js"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>
    </body>
</html>
