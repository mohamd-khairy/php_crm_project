<!-- Content Header (Page header) -->
<?php
$data = UserModel::get_users_desc($_SESSION['acc_id']);
?>



<div class="box box-warning" >

    <section class="content-header">
        <div class="box-header with-border has-error">
            <h3 class="box-title" style="margin-right: 70%">الموظفين</h3>
        </div>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> الصفحه الرئيسيه</a></li>
            <li class="active">الموظفين</li>
        </ol>
    </section>
    <!-- /.box-header -->
    <div class="box-body">
        <!-- PRODUCT LIST -->
        
        <div class="col-md-12">
            <!-- USERS LIST -->
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">أحدث الموظفين</h3>

                    <div class="box-tools pull-right">
                        <span class="label label-danger"><?php
                            $i = 0;
                            foreach ($data as $c) {
                                if ($c['acc_id'] == $_SESSION['acc_id']) {

                                    if (date('Y-m-d') == $c['user_date']) {
                                        $i++;
                                    }
                                }
                            }

                            echo $i;
                            ?> عضو جديد</span>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <ul class="users-list clearfix">
                        <?php foreach ($data as $user) { ?>
                            <li>
                                <img src="<?= HostName . DS . 'img' . DS . $user['user_image'] ?>" style="width: 110px;height: 110px;" alt="User Image">

                                <a class="users-list-name" href="index.php?rt=User/profile&user_id=<?= $user['user_id'] ?>"><?= $user['user_name'] ?></a>

                                <span class="users-list-date"><?= $user['user_date'] ?></span>
                            </li>
                        <?php } ?> 
                    </ul>
                    <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                    <a href="?rt=User/showall" class="uppercase">كل الموظفين </a>
                </div>
                <!-- /.box-footer -->
            </div>
            <!--/.box -->
        </div>
        <!-- /.box -->
        <div style="margin-top: 60%"></div>

    </div>

</div>
<!-- /.box-body -->


