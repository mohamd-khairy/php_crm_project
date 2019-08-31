<?php
if(isset($_SESSION['acc_id'])){
if(!isset($_SESSION['user_id']) ){ 
$data_acc=AccountModel::getAllDatabyid($_SESSION['acc_id']);
if(!empty($data_acc)){
$acc=$data_acc[0];
}
}else{
$data=UserModel::getAllDatabyid($_SESSION['user_id']);
if(!empty($data)){
$user=$data[0];
}
}
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <?php if(!isset($_SESSION['user_id'])) { ?>

            <div class="pull-left image">
                <img src="<?= HostName.DS.'img'.DS.$acc['acc_image']?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?= $acc['acc_name']?></p>
                <a href="#"><i class="fa fa-circle text-success"></i><?= $acc['role']?></a>
            </div>
            <?php }else{ ?>
            <div class="pull-left image">
                <img src="<?= HostName.DS.'img'.DS.$user['user_image']?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?= $user['user_name']?></p>
                <a href="#"><i class="fa fa-circle text-success"></i><?= $user['role']?></a>
            </div>
            <?php } ?>
        </div>
        <!-- search form -->
        <form action="?rt=HomePage/search" method="post" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="search_name" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">القائمه الرئيسيه</li>
            <li class=" treeview">
                
                <a href="?rt=HomePage/index">
                    <i class="active fa fa-dashboard"></i> <span>الصفحه الرئيسيه</span>
                </a>
            </li>
            <li class=" treeview">
                <a href="?rt=HomePage/index2">
                    <i class="active fa fa-comments"></i> <span>شــات</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-green" >جديد</small>
                    </span>

                </a> </li>

            <?php if($_SESSION['role'] != 'user'){ ?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i> <span>الموظفين</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>

                </a>
                <ul class="treeview-menu">
                    <li><a href="index.php?rt=User/add"><i class="fa fa-circle-o"></i> جديد</a></li>
                    <li><a href="index.php?rt=User/show"><i class="fa fa-circle-o"></i> الكل</a></li>

                </ul>
            </li>
            <?php } ?>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>العملاء</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="index.php?rt=Contact/add"><i class="fa fa-circle-o"></i> جديد</a></li>

                    <li><a href="index.php?rt=Contact/show"><i class="fa fa-circle-o"></i> الكل</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-phone"></i> <span>المكالمات</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="index.php?rt=Call/addother"><i class="fa fa-circle-o"></i> جديد</a></li>

                    <li><a href="index.php?rt=Call/show"><i class="fa fa-circle-o"></i> الكل</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>المهمات</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="?rt=Task/task"><i class="fa fa-circle-o"></i> مهمه للعملاء</a></li>
                    <?php if($_SESSION['role'] != 'user'){ ?>
                    <li><a href="?rt=Task/taskuser"><i class="fa fa-circle-o"></i> مهمه للموظفين</a></li>
                    <?php  } ?>
                </ul>
            </li>

            <?php if($_SESSION['role'] != 'user'){ ?>
            <li class="treeview">
                <a href="?rt=Company/show">
                    <i class="fa fa-pie-chart"></i>
                    <span>الشركات</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-fuchsia" id="count_company"></small>
                    </span>
                </a>
            </li>


            <li class="treeview">
                <a href="index.php?rt=Deal/show">
                    <i class="fa fa-edit"></i> <span>الصفقات</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-green" id="count_deal"></small>

                    </span>
                </a>

            </li>

            <?php } ?>



            <li>
                <a href="index.php?rt=Email/show">
                    <i class="fa fa-envelope"></i> <span>الايميلات</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-yellow" id="count_email"></small>
                    </span>
                </a>
            </li>

            <li>
                <a href="index.php?rt=Event/show">
                    <i class="fa fa-calendar"></i> <span>أحداث</span>

                    <span class="pull-right-container">
                        <small class="label pull-right bg-red" id="count_event"></small>

                    </span>
                </a>
            </li>


            <?php  if($_SESSION['role']=='manager'){ ?>
            <li class="treeview">
                <a href="index.php?rt=Activity/show">
                    <i class="fa fa-folder"></i> <span>نشاطات</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-gray" id="count"></small>
                    </span>
                </a>
            </li>
            <script src = "http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" ></script>
            <script type="text/javascript">
                window.setInterval('refresh_()', 1000);
                function refresh_() {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.open("GET", "?rt=Activity/count_noty", false);
                    xmlhttp.send(null);
                    document.getElementById("count").innerHTML = xmlhttp.responseText;
                }
            </script>
            <?php } ?>

            <?php if($_SESSION['role'] != 'user'){ ?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-file"></i> <span>تقارير</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="index.php?rt=Report/show"><i class="fa fa-circle-o"></i>  العملاء</a></li>
                    <li><a href="index.php?rt=Report/showuser"><i class="fa fa-circle-o"></i> الموظفين</a></li>
                    <li><a href="index.php?rt=Report/showcompany"><i class="fa fa-circle-o"></i> الشركات</a></li>

                </ul>
            </li>
            <?php }  ?>

        </ul>
        <div style="margin-top: 10%"></div>
    </section>
    <!-- /.sidebar -->
    <div style="margin-top: 20%"></div>

</aside>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">

                window.setInterval('refresh_right()', 1000);
                function refresh_right() {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.open("GET", "?rt=Email/count_email", false);
                    xmlhttp.send(null);
                    document.getElementById("count_email").innerHTML = xmlhttp.responseText;

                    xmlhttp.open("GET", "?rt=Event/count_event", false);
                    xmlhttp.send(null);
                    document.getElementById("count_event").innerHTML = xmlhttp.responseText;

                    xmlhttp.open("GET", "?rt=Company/count_company", false);
                    xmlhttp.send(null);
                    document.getElementById("count_company").innerHTML = xmlhttp.responseText;

                    xmlhttp.open("GET", "?rt=Deal/count_deal", false);
                    xmlhttp.send(null);
                    document.getElementById("count_deal").innerHTML = xmlhttp.responseText;


                }
</script>
<?php }?>
