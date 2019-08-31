
<section class="content-header">
    <h1>
        المهمات
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> الصفحه الرئيسيه</a></li>
        <li class="active">المهمات</li>

    </ol>
</section>

<div class="row"  >

    <?php
    if (isset($_GET['m']) && $_GET['m'] == 'call') {
        $data = TaskModel::get_task_by_method_acc_id_offset('call', $offset, $_SESSION['acc_id']);
    } elseif (isset($_GET['m']) && $_GET['m'] == 'email') {
        $data = TaskModel::get_task_by_method_acc_id_offset('email', $offset, $_SESSION['acc_id']);
    } elseif (isset($_GET['m']) && $_GET['m'] == 'meeting') {
        $data = TaskModel::get_task_by_method_acc_id_offset('meeting', $offset, $_SESSION['acc_id']);
        // print_r($data);
    } else {
        
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
                                        <th style="width: 40px">احذف</th>
                                    <?php } ?>

                                    <th>الايميل</th>
                                    <th>التليفون</th>
                                    <th>العميل</th>
                                    <th>مستوي الصعوبه</th>
                                    <th>المهمه</th>
                                    <th style="width: 10px">#</th>
                                </tr>
                                <?php
                                $i = 1;
                                foreach ($data as $t) {
                                    ?>
                                    <tr>
                                        <?php if ($_SESSION['role'] != 'user') { ?>
                                            <td><a href="index.php?rt=Task/delete&task_id=<?= $t['task_id'] ?>"><span class="badge bg-red">احذف</span></a></td>
                                        <?php } ?>

                                        <td><?= $t['contact_email'] ?></td>
                                        <td><?= $t['contact_phone'] ?></td>
                                        <td><?= $t['contact_name'] ?></td>
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

                                        <td><?= $i++ ?></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">
                            <ul class="pagination pagination-sm no-margin pull-right">
                                <ul class="pagination pagination-sm inline">
                                    <li><a href="#">&laquo;</a></li>
                                    <?php
                                    for ($i = 1; $i <= $count; $i++) {
                                        $current = ($i - 1) * PER_PAGE_COUNT;
                                        ?>
                                        <li><a href="index.php?rt=Task/show&m=<?= $_GET['m'] ?>&pg=<?= $current ?>"><?= $i ?></a></li>
                                    <?php } ?>

                                    <li><a href="#">&raquo;</a></li>
                                </ul>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div style="margin-top: 50%"></div>
        </section>
    <?php } else { ?>
        <div class="box-body">
            <div class="alert alert-danger h4" role="alert"><strong>خطأ!</strong>..لا يوجد مهمه موجوده حاليا..</div>
            <div style="margin-top: 60%"></div>
        </div>

    <?php } ?>
</div>





