

<?php if (isset($_SESSION['msg']) && $_SESSION['msg'] == -1) { ?>
    <div class="box-body">
        <div class="alert alert-danger h4" role="alert"><strong>خطأ!</strong>.. ليس مسموح لك بالدخول الان!!.. </div></div>
    <?php
}
?>

<!DOCTYPE html>
<?php if (!isset($_COOKIE['user_role']) && !isset($_SESSION['acc_id'])) {
    ?>
    <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title> تسجيل الدخول|علم</title>
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
        <body class="hold-transition login-page" >
            <div class="login-box">
                <div class="login-logo">
                    <a href="index.php"><b>أدمن</b>علم</a>
                </div>
                <!-- /.login-logo -->
                <div class="login-box-body">
                    <p class="login-box-msg">سجل دخولك لتبدأ جلستك</p>

                    <form action="?rt=HomePage/login" method="post">
                        <div class="form-group has-feedback">
                            <input type="email" name="email" class="form-control" placeholder="ايميل">
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="password" name="password" class="form-control" placeholder="كلمه السر">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <div class="row">
                            <div class="col-xs-8" style="margin-left: 10%">
                                <div class="checkbox icheck">
                                    <label>
                                        <input type="checkbox" value="1" name="check[]"> تذكرني
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-xs-4" style="margin-left: 33%">
                                <button type="submit" class="btn btn-primary btn-block btn-flat"> تسجيل الدخول</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    <div class="social-auth-links text-center">
                        <p>- أو -</p>
                        <a href="../crm_company_ar/index3.php" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> تسجيل الدخول بواسطه فيسبوك
                            </a>
                        <a href="../crm_company_ar/index2.php" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> تسجيل الدخول بواسطه جوجل</a>
                    </div>


                    <!--                    <a href="#">I forgot my password</a><br>-->
                    <a href="?rt=HomePage/register" class="text-center">تسجيل حساب جديد</a>

                </div>
                <!-- /.login-box-body -->
            </div>
            <!-- /.login-box -->

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
    <?php
} else {
    switch ($_COOKIE['user_role']) {
        case 'admin':
            // echo 'here';
            $_SESSION['role'] = 'admin';
            if (!isset($_SESSION['user_id'])) {
                $_SESSION['user_id'] = $_COOKIE['user_id'];
            }
            $m = UserModel::getDatabyid_for_cookie($_COOKIE['user_id'])[0]['acc_id'];
            $_SESSION['acc_id'] = $m;
            header('location:?rt=HomePage/index2');
            break;
        case 'user':
            // echo 'now';
            $_SESSION['role'] = 'user';
            if (!isset($_SESSION['user_id'])) {
                $_SESSION['user_id'] = $_COOKIE['user_id'];
            }
            $m = UserModel::getDatabyid_for_cookie($_COOKIE['user_id'])[0]['acc_id'];
            $_SESSION['acc_id'] = $m;
            header('location:?rt=HomePage/index3');

            break;
        case 'manager':
            $_SESSION['role'] = 'manager';
            if (!isset($_SESSION['acc_id'])) {
                $_SESSION['acc_id'] = $_COOKIE['acc_id'];
            }
            header('location:index.php');

            break;

        default:
            header('location:index.php');
            break;
    }
}
?>