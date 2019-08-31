<!-- Content Header (Page header) -->
<?php
$data = UserModel::getAll($offset);
//print_r($data);
?>
<div class="box-body">
    <section class="content-header">
        <h1>
            كل الموظفين
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> الصقحه الرئيسيه</a></li>
            <li class="active">الموظفين</li>
            <li class="active">الكل</li>
        </ol>
    </section>

    <!-- TABLE: LATEST ORDERS -->
    <div class="col-md-2">
        <div style="margin-top: 10%" class="box box-info">

            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">اختر</h3>

                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">
                         <li><a href="index.php?rt=Email/senduser"><i class="fa fa-envelope-o"></i>ارسل ايميل

                            </a></li>
                        <li><a href="index.php?rt=Call/Adduser"><i class="fa fa-phone"></i>اضف مكالمه
                            </a></li>
                        <li><a href="?rt=Deal/adduser"><i class="fa fa-money"></i>اضف صفقه
                            </a></li>
                             <li><a href="?rt=Task/taskuser"><i class="fa fa-tasks"></i>اضف مهمه
                            </a></li>

                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /. box -->
        </div>
    </div>
    <div class="col-md-10">
        <div style="margin-top: 2%" class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">الاحدث</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="direction: ltr">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                            <tr>
                                <?php if ($_SESSION['role'] != 'user')  ?>
                                <th>احذف</th>
                                <th> بدايه العمل</th>
                                <th>التليفون</th>
                                <th>الصلاحيه</th>
                                <th>الوظيفه</th>
                                <th>الاسم</th>
                                <th>رقم</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $n = 1;
                            foreach ($data as $user) {
                                if ($user['acc_id'] == $_SESSION['acc_id']) {
                                    ?>
                                    <tr>

                                        <?php if ($_SESSION['role'] != 'user') { ?>
                                            <td>
                                                <div class="btn-group">

                                                    <a href="index.php?rt=User/delete&user_id=<?= $user['user_id'] ?>" type="button"  class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></a>

                                                </div>
                                            </td>
                                        <?php } ?>
                                        <td>
                                            <div class="sparkbar" data-color="#00a65a" data-height="20"><?= $user['user_date'] ?></div>
                                        </td>
                                        <td><a href="#"><?= $user['user_phone'] ?></a></td>
                                        <td><span class="label label-success"><?= $user['role'] ?></span></td>

                                        <td><?= $user['user_job'] ?></td>

                                        <td><a href="?rt=User/profile&user_id=<?= $user['user_id'] ?>"><?= $user['user_name'] ?></a></td>

                                        <td> <?= $n++ ?></td>

                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <a href="?rt=User/add" class="btn btn-sm btn-info btn-flat pull-left">موظف جديد</a>
                <div class="box-tools pull-right">
                    <ul class="pagination pagination-sm inline">
                        <li><a href="#">&laquo;</a></li>
                        <?php
                        for ($i = 1; $i <= $count; $i++) {
                            $current = ($i - 1) * PER_PAGE_COUNT;
                            ?>
                            <li><a href="index.php?rt=User/showall&pg=<?= $current ?>"><?= $i ?></a></li>
                        <?php } ?>

                        <li><a href="#">&raquo;</a></li>
                    </ul>
                </div>    </div>
            <!-- /.box-footer -->

        </div>
    </div>
    <div style="margin-top: 50%"></div>
</div>

<!-- /.box -->
