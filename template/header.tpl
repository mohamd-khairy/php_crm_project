<?php 
//error_reporting(0);
if(isset($_SESSION['acc_id'])){
if(isset($_SESSION['user_id'])){
$data=UserModel::getAllDatabyid($_SESSION['user_id']);
if(count($data) == 0){
session_unset();
header('location:index.php');
}
}else{
$data=AccountModel::getAllDatabyid($_SESSION['acc_id']);
if(count($data) == 0){
session_unset();
header('location:index.php');
}
}
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php 
        if(isset($_SESSION['acc_id']) && isset($_GET['rt'])){ 
        ?>
        <title>  إداره | علم</title>
        <?php }elseif(isset($_SESSION['acc_id'])){ ?>
        <title> الصفحه الرئيسيه | علم</title>

        <?php }?>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="plugins/awesome/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
        <!-- bootstrap datepicker -->
        <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
        <!-- iCheck for checkboxes and radio inputs -->

        <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
        <!-- Morris chart -->
        <link rel="stylesheet" href="plugins/morris/morris.css">
        <!-- jvectormap -->
        <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
        <!-- Date Picker -->
        <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- fullCalendar 2.2.5-->
        <link rel="stylesheet" href="../plugins/fullcalendar/fullcalendar.min.css">
        <link rel="stylesheet" href="../plugins/fullcalendar/fullcalendar.print.css" media="print">
        <!-- Theme style -->
        <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->

        <link rel="stylesheet" type="text/css" href="styleloading.css">

    </head>
    <?php 
    if(isset($_SESSION['acc_id'])){ 
    if(isset($_SESSION['user_id'])){ 
    $data=UserModel::getAllDatabyid($_SESSION['user_id']);
    if(!empty($data)){
    $user=$data[0];
    }
    }
    else{
    $data_acc=AccountModel::getAllDatabyid($_SESSION['acc_id']);
    if(!empty($data_acc)){
    $acc=$data_acc[0];

    }
    }
    ?>
    <body class="hold-transition skin-blue sidebar-collapse   sidebar-mini" id="mizo" >
          
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript">
      
        window.setInterval(
                function () {
                    var xmlhttp = new XMLHttpRequest();

                    xmlhttp.open("GET", "?rt=Task/count_task_show", false);
                    xmlhttp.send(null);
                    document.getElementById("count_task_show").innerHTML = xmlhttp.responseText;


                    xmlhttp.open("GET", "?rt=Task/task_show", false);
                    xmlhttp.send(null);
                    document.getElementById("task_show").innerHTML = xmlhttp.responseText;


                    xmlhttp.open("GET", "?rt=Email/emailnoty", false);
                    xmlhttp.send(null);
                    document.getElementById("emailnoty").innerHTML = xmlhttp.responseText;



                    xmlhttp.open("GET", "?rt=Email/count_email_show", false);
                    xmlhttp.send(null);
                    document.getElementById("count_email_show").innerHTML = xmlhttp.responseText;


                    xmlhttp.open("GET", "?rt=Activity/notiyajax", false);
                    xmlhttp.send(null);
                    document.getElementById("noty").innerHTML = xmlhttp.responseText;


                    xmlhttp.open("GET", "?rt=Activity/count_show_noty", false);
                    xmlhttp.send(null);
                    document.getElementById("count_show").innerHTML = xmlhttp.responseText;

                    return false;
                }, 3000);

        </script>




        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="index.php" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>علم</b></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>إداره </b>علم</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas"  role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    
                  
                    
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown messages-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="label label-success" >
                                        <div id="count_email_show"></div>
                                    </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <ul class="menu" id="emailnoty">
                                        </ul>
                                    </li>
                                    <li class="footer"><a href="?rt=Email/show">كل لايميلات</a></li>
                                </ul>
                            </li>

                            <li class="dropdown tasks-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-flag-o"></i>

                                    <span class="label label-danger" >
                                        <div id="count_task_show"></div>

                                    </span>

                                </a>


                                <ul class="dropdown-menu">
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu" id="task_show">

                                        </ul>
                                    </li>
                                    <li class="footer">
                                        <a href="?rt=Task/task">كل المهمات</a>
                                    </li>
                                </ul>
                            </li>
                            <?php if($_SESSION['role']=='manager'){ ?>
                            <!-- Notifications: style can be found in dropdown.less -->
                            <li class="dropdown notifications-menu">

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-bell-o"></i>
                                    <span class="label label-warning" >
                                        <div id="count_show"></div>

                                    </span>                                    
                                </a>
                                <ul class="dropdown-menu">

                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu" id="noty">
                                        </ul>
                                    </li>
                                    <li class="footer"><a href="index.php?rt=Activity/show">الكل</a></li>
                                </ul>
                            </li>


                            <?php } ?>
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <?php if(!isset($_SESSION['user_id']) ){ 
                                    ?>
                                    <img src="<?= HostName.DS.'img'.DS.$acc['acc_image']?>" class="user-image" alt="User Image">
                                    <span class="hidden-xs"><?= $acc['acc_name']?></span>
                                    <?php }else{ ?>
                                    <img src="<?= HostName.DS.'img'.DS.$user['user_image']?>" class="user-image" alt="User Image">
                                    <span class="hidden-xs"><?= $user['user_name']?></span>

                                    <?php   } ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <?php if(!isset($_SESSION['user_id']) ){ 
                                        ?>
                                        <img src="<?= HostName.DS.'img'.DS.$acc['acc_image']?>" class="img-circle" alt="User Image">
                                        <p>
                                            <?= $acc['acc_name']?>
                                            <small><?= $acc['acc_start_date']?></small>
                                        </p>
                                        <?php }else{ ?>
                                        <img src="<?= HostName.DS.'img'.DS.$user['user_image']?>" class="img-circle" alt="User Image">
                                        <p>
                                            <?= $user['user_name']?> - <?= $user['user_job']?>
                                            <small><?= $user['user_date']?></small>
                                        </p>         
                                        <?php } ?>
                                    </li>

                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <?php if(!isset($_SESSION['user_id'])){ 
                                            ?>
                                            <a href="?rt=User/acc_profile&acc_id=<?=$_SESSION['acc_id']?>" class="btn btn-default btn-flat">الصفحه الشخصيه</a>

                                            <?php }else{ ?>
                                            <a href="?rt=User/profile&user_id=<?=$_SESSION['user_id']?>" class="btn btn-default btn-flat">الصفحه الشخصيه</a>

                                            <?php } ?>
                                        </div>
                                        <div class="pull-right">
                                            <a  href="?rt=HomePage/logout"  class="btn btn-default btn-flat">تسجيل الخروج </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                            <li>
                                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <?php } ?>