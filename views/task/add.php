
<div class="box-header with-border has-error">
    <h3 class="box-title" style="margin-right: 70%">اضافه مهمه</h3>
</div>
<?php
if (isset($msg) || isset($error)) {
    if ($msg == 1) {
        ?>
        <div class="box-body" >
            <div class="alert alert-success h5" role="alert">تمت الاضافه بنجاح...</div></div>
    <?php } else if ($msg == -1) { ?>
        <div class="box-body" >    <div class="alert alert-danger h4" role="alert"><strong>خطأ!</strong>.. لم تتم الاضافه ..  <?php
                if (isset($error)) {
                    echo $error;
                }
                ?></div>
        </div>       
        <?php
    }
}
?>

<div class="row">
    <?php
    $data = TaskModel::get_all_task_and_contact_by_acc_id($_SESSION['acc_id']);
    // print_r($data);
    ?>
    <div class="col-md-4">
        <!-- /.box-header -->
        <div class="box-body">
            <!-- PRODUCT LIST -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">مكالمه</h3>

                    <div class="box-tools pull-right">
                        <a href='?rt=Task/show&m=call' class="btn btn-box-tool" ><i class="fa fa-table" ></i>
                        </a>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <ul class="products-list product-list-in-box">
                        <?php
                        foreach ($data as $call) {
                            if ($call['acc_id'] == $_SESSION['acc_id']) {
                                if ((!empty($call['task_method']) ) && $call['task_method'] == 'call') {
                                    ?>
                        
                                    <li class="item">
                                        <div class="product-img">
                                            <img src="<?= HostName . DS . 'img' . DS . 'task.jpg' ?>" alt="Product Image">
                                        </div>
                                        <div class="product-info">
                                            <a href="index.php?rt=Task/showone&m=call&task_id=<?= $call['task_id'] ?>" class="product-title"><?= $call['contact_name'] ?>
                                                <?php if ($call['task_periority'] == 'hard') { ?>
                                                    <span class="label label-danger pull-right"><?= $call['task_periority'] ?></span></a>
                                            <?php } elseif ($call['task_periority'] == 'normal') { ?>

                                                <span class="label label-warning pull-right"><?= $call['task_periority'] ?></span></a>
                                            <?php } else { ?>

                                                <span class="label label-success pull-right"><?= $call['task_periority'] ?></span></a>
                                            <?php } ?>
                                            <span class="product-description">
                                                <?= $call['task_name'] ?>
                                            </span>
                                        </div>
                                    </li>
                        
                                    <?php
                                }
                            }
                        }
                        ?>
                    </ul>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                    <form method="post">
                        <input type="hidden" name="task_method" value="call" />
                        <input  type="submit" value="اضف مهمه" class="uppercase">
                    </form>
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
    </div>

    <div class="col-md-4">
        <!-- /.box-header -->
        <div class="box-body">
            <!-- PRODUCT LIST -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">إيميل</h3>

                    <div class="box-tools pull-right">
                        <a href='?rt=Task/show&m=email' class="btn btn-box-tool" ><i class="fa fa-table" ></i>
                        </a>

                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <ul class="products-list product-list-in-box">
                        <?php
                        foreach ($data as $call) {
                            if ($call['acc_id'] == $_SESSION['acc_id']) {

                                if (!empty($call['task_method']) && $call['task_method'] == 'email') {
                                    ?>
                                    <li class="item">
                                        <div class="product-img">
                                            <img src="<?= HostName . DS . 'img' . DS . 'task.jpg' ?>" alt="Product Image">
                                        </div>
                                        <div class="product-info">
                                            <a href="index.php?rt=Task/showone&m=email&task_id=<?= $call['task_id'] ?>" class="product-title"><?= $call['contact_name'] ?>
                                                <?php if ($call['task_periority'] == 'hard') { ?>
                                                    <span class="label label-danger pull-right"><?= $call['task_periority'] ?></span></a>
                                            <?php } elseif ($call['task_periority'] == 'normal') { ?>

                                                <span class="label label-warning pull-right"><?= $call['task_periority'] ?></span></a>
                                            <?php } else { ?>

                                                <span class="label label-success pull-right"><?= $call['task_periority'] ?></span></a>
                                            <?php } ?>                                            <span class="product-description">
                                            <?= $call['task_name'] ?>
                                            </span>
                                        </div>
                                    </li>

                                    <?php
                                }
                            }
                        }
                        ?>
                    </ul>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                    <form method="post">
                        <input type="hidden" name="task_method" value="email" />
                        <input  type="submit" value="اضف مهمه" class="uppercase">
                    </form>
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
    </div>

    <div class="col-md-4">
        <!-- /.box-header -->
        <div class="box-body">
            <!-- PRODUCT LIST -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">مقابله</h3>

                    <div class="box-tools pull-right">
                        <a href='?rt=Task/show&m=meeting' class="btn btn-box-tool" ><i class="fa fa-table" ></i>
                        </a>

                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <ul class="products-list product-list-in-box">
                        <?php
                        foreach ($data as $call) {
                            if ($call['acc_id'] == $_SESSION['acc_id']) {

                                if (!empty($call['task_method']) && $call['task_method'] == 'meeting') {
                                    ?>
                                    <li class="item">
                                        <div class="product-img">
                                            <img src="<?= HostName . DS . 'img' . DS . 'task.jpg' ?>" alt="Product Image">
                                        </div>
                                        <div class="product-info">
                                            <a href="index.php?rt=Task/showone&m=meeting&task_id=<?= $call['task_id'] ?>" class="product-title"><?= $call['contact_name'] ?>
                                                <?php if ($call['task_periority'] == 'hard') { ?>
                                                    <span class="label label-danger pull-right"><?= $call['task_periority'] ?></span></a>
                                            <?php } elseif ($call['task_periority'] == 'normal') { ?>

                                                <span class="label label-warning pull-right"><?= $call['task_periority'] ?></span></a>
                                            <?php } else { ?>

                                                <span class="label label-success pull-right"><?= $call['task_periority'] ?></span></a>
                                            <?php } ?>                                            <span class="product-description">
                                            <?= $call['task_name'] ?>
                                            </span>
                                        </div>
                                    </li>

                                    <?php
                                }
                            }
                        }
                        ?>
                    </ul>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                    <form method="post" >
                        <input type="hidden" name="task_method" value="meeting" />
                        <input  type="submit"   value="اضف مهمه" class="uppercase">
                    </form>
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <div style="margin-top: 60%"></div>
</div>

<!-- /.box-body -->

<!-- /.box -->


