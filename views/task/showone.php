
<?php
if (isset($msg)) {
    if ($msg == 1) {
        ?>
        <div class="alert alert-success h5" role="alert">Operation Do Successfully...</div>
    <?php } else if ($msg == -1) { ?>
        <div class="alert alert-danger h4" role="alert"><strong>Error!</strong>..some thing wrong..</div>
        <?php
    }
}
?>
<section class="content-header">
    <h1>
        المهمات
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> الصفحه الرئيسيه</a></li>
        <li class="active">المهمه</li>

    </ol>
</section>


<?php
$tt = TaskModel::getAllDatabyid(intval($_GET['task_id']));
if ($tt[0]['contact_id'] == 0 && $_SESSION['role'] == 'user') {
    $data = array();
}else{
if (!empty($tt) && $tt[0]['contact_id'] != 0) {
    if (isset($_GET['m']) && isset($_GET['task_id']) && $_GET['m'] == 'call') {
        $data = TaskModel::get_task_by_method_task_id_acc_id('call', intval($_GET['task_id']), $_SESSION['acc_id']);
    } elseif (isset($_GET['m']) && isset($_GET['task_id']) && $_GET['m'] == 'email') {
        $data = TaskModel::get_task_by_method_task_id_acc_id('email', intval($_GET['task_id']), $_SESSION['acc_id']);
    } elseif (isset($_GET['m']) && isset($_GET['task_id']) && $_GET['m'] == 'meeting') {
        $data = TaskModel::get_task_by_method_task_id_acc_id('meeting', intval($_GET['task_id']), $_SESSION['acc_id']);
        //print_r($data);
    } else {
        ?>
        <div class="alert alert-danger h4" role="alert"><strong>خطا!</strong>..يوجد شئ غير صحيح..</div>

        <?php
    }
} else {
    if (isset($_GET['m']) && isset($_GET['task_id']) && $_GET['m'] == 'call') {
        $data = TaskModel::get_task_by_method_task_id_acc_id_user('call', intval($_GET['task_id']), $_SESSION['acc_id']);
    } elseif (isset($_GET['m']) && isset($_GET['task_id']) && $_GET['m'] == 'email') {
        $data = TaskModel::get_task_by_method_task_id_acc_id_user('email', intval($_GET['task_id']), $_SESSION['acc_id']);
    } elseif (isset($_GET['m']) && isset($_GET['task_id']) && $_GET['m'] == 'meeting') {
        $data = TaskModel::get_task_by_method_task_id_acc_id_user('meeting', intval($_GET['task_id']), $_SESSION['acc_id']);
        //print_r($data);
    } else {
        ?>
        <div class="alert alert-danger h4" role="alert"><strong>خطا!</strong>..يوجد شئ غير صحيح..</div>

        <?php
    }
}
}
if (isset($_GET['m']) && (!empty($data))) {
    ?>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">الكل</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <?php if ($_SESSION['role'] != 'user') { ?>

                                    <th style="width: 40px">الحذف</th>
                                <?php } ?>

                                <th>الايميل</th>
                                <th>التليفون</th>
                                <th>العميل</th>
                                <th>مستوي الصعوبه</th>
                                <th>المهمه</th>
                                <th style="width: 10px">#</th>
                            </tr>
                            <?php
                            $i = 0;
                            foreach ($data as $t) {
                                ?>
                                <tr>
                                    <?php if ($_SESSION['role'] != 'user') { ?>
                                        <td><a href="index.php?rt=Task/delete&task_id=<?= $t['task_id'] ?>"><span class="badge bg-red">احذف</span></a></td>
                                        <?php
                                    }
                                    if (!empty($t) && $t['contact_id'] != 0) {
                                        ?>
                                        <td><?= $t['contact_email'] ?></td>
                                        <td><?= $t['contact_phone'] ?></td>
                                        <td><?= $t['contact_name'] ?></td>

                                    <?php } else { ?>
                                        <td><?= $t['user_email'] ?></td>
                                        <td><?= $t['user_phone'] ?></td>
                                        <td><?= $t['user_name'] ?></td>

                                    <?php } ?>
                                    <td>
                                        <div >
                                            <?php if ($t['task_periority'] == 'hard') { ?>
                                                <span class="badge bg-red">صعب</span>

                                            <?php } elseif ($t['task_periority'] == 'normal') { ?>
                                                <span class="badge bg-warning">متوسط</span>

                                            <?php } else { ?>
                                                <span class="badge bg-green">سهل</span>

                                            <?php } ?>
                                        </div>
                                    </td>
                                    <td><?= $t['task_name'] ?></td>

                                    <td><?= ++$i ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                    <!-- /.box-body -->

                </div>
            </div>
        </div>
        <div style="margin-top: 50%"></div>
    </section>
<?php } else { ?>

    <div class="box-body">
        <div class="alert alert-danger h4" role="alert"><strong>خطا!</strong>..يوجد شئ غير صحيح!! ..</div>
        <div style="margin-top: 60%"></div>
    </div>
<?php } ?>
       







