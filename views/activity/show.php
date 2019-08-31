

<section class="content-header">

    <h1>
        <i class="ion ion-clipboard"></i> النشاطات 
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> الصفحه الرئيسيه</a></li>
        <li class="active">الانشطه</li>
    </ol>
</section>
<?php
if (isset($_GET['d'])) {
    $data = ActivityModel::get_all_activity_user_by_date_day($offset, $_GET['d']);
} elseif (isset($_GET['m'])) {
    $user = ActivityModel::get_all_activity_user($offset);
    $data = array();
    foreach ($user as $info) {
        if ((explode('-', $info['act_datetime'])[1]) == $_GET['m']) {
            $data[] = $info;
        }
    }
} elseif (isset($_GET['y'])) {
    $user = ActivityModel::get_all_activity_user($offset);
    $data = array();
    foreach ($user as $info) {
        if ((explode('-', $info['act_datetime'])[0]) == $_GET['y']) {
            $data[] = $info;
        }
    }
} elseif (isset($_GET['u'])) {
    $data = ActivityModel::get_act_by_user_id_desc($_GET['u']);
    //  print_r($data);
} else {
    $data = ActivityModel::get_all_activity_user($offset);
}
?>
<div class="box-body">  
    <div class="box box-primary" style="margin-top: 1%">
        <div class="box-header">
            <h3  style="margin-left: 70%"class="box-title"></h3>

            <div class="btn-group">
                <?php if (isset($_GET['u']) && !empty($data)) { ?>
                    <button type="button" class="btn btn-default  btn-sm dropdown-toggle"><?= $data[0]['user_name'] ?></button>
                <?php } else { ?>
                    <button type="button" class="btn btn-default  btn-sm dropdown-toggle">اختار الموظف </button>
                <?php } ?>

                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-sort-down"></i></button>
                <ul class="dropdown-menu pull-right" role="menu">

                    <?php
                    $user = UserModel::getAllData_by_acc_id($_SESSION['acc_id']);
                    foreach ($user as $u) {
                        if ($u['acc_id'] == $_SESSION['acc_id']) {
                            ?>
                            <li><a href="?rt=Activity/show&u=<?= $u['user_id'] ?>"><?= $u['user_name'] ?></a></li>

                        <?php }
                    }
                    ?>
                    <li class="divider"></li>
                    <li><a href="?rt=Activity/show" >الكل</a></li>
                </ul>
            </div>

            <div class="btn-group">
                <button type="button" class="btn btn-default  btn-sm dropdown-toggle"> اختر التاريخ</button>
                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-sort-down"></i></button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li><a href="?rt=Activity/show&d=<?= date('Y-m-d') ?>">اليوم</a></li>
                    <li><a href="?rt=Activity/show&d=<?= date('Y-m-d', strtotime("-1 days")) ?>">أمس</a></li>
                    <li><a href="?rt=Activity/show&m=<?= date('m') ?>">هذا الشهر</a></li>
                    <li><a  href="?rt=Activity/show&m=<?= date('m', strtotime("-1 month")) ?>"> الشهر الماضي</a></li>
                    <li><a href="?rt=Activity/show&y=<?= date('Y') ?>">هذه السنه</a></li>
                    <li><a href="?rt=Activity/show&y=<?= date('Y', strtotime("-1 years")) ?>"> السنه الماضيه</a></li>

                    <li class="divider"></li>
                    <li><a href="?rt=Activity/show" >الكـل</a></li>
                </ul>
            </div>

            <a type="button" href="?rt=Activity/delete_all" class="btn btn-danger  btn-sm dropdown-toggle"> حذف الكل </a>
        </div>
        <!-- /.box-header -->

        <div class="box-body">
          
            <ul class="todo-list" id="all">
  <li>              
  <?php
                if (!empty($data)) {
                    foreach ($data as $act) {
                        if ($act['acc_id'] == $_SESSION['acc_id']) {
                            ?>
                          
                                <div style="margin-top: 1%" class="box-footer box-comments">
                                    <!-- User image -->
                                    <img class="img-circle img-sm" src="<?= HostName . DS . 'img' . DS . $act['user_image'] ?>" alt="User Image">
                                    <div class="comment-text">
                                        <span class="username">
                                            <a href="?rt=Activity/showone&act_id=<?= $act['act_id'] ?>"> <?=
                                                $act['user_name'];
                                                ?>
                                            </a>
                                            <span class="text-muted pull-right"><?= date('A h:i D-m-Y',$act['act_datetime']) ?></span>
                                        </span><!-- /.username -->
            <?= $act['act_details'] ?> 
                                    </div>
                                    <!-- /.comment-text -->
                                </div>
                            
                            <?php
                        }
                    }
                }
                ?>
</li>
            </ul>
            <!-- /.box-body -->
            <div class="box-tools pull-right">
                <ul class="pagination pagination-sm inline">
                    <li><a href="#">&laquo;</a></li>
                    <?php
                    for ($i = 1; $i <= $count; $i++) {
                        $current = ($i - 1) * PER_PAGE_COUNT;
                        ?>
                        <li><a href="index.php?rt=Activity/show&pg=<?= $current ?>"><?= $i ?></a></li>
<?php } ?>

                    <li><a href="#">&raquo;</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div style="margin-top: 60% "></div>
</div>