<!-- Content Header (Page header) -->
<?php
if (isset($msg) || isset($error)) {
    if ($msg == 1) {
        ?>
        <div class="box-body">
            <div class="alert alert-success h5" role="alert">تمت  التعديل بنجاح...</div>

        </div>
    <?php } else if ($msg == -1) { ?>
        <div class="box-body">
            <div class="alert alert-danger h4" role="alert"><strong>خطأ!</strong>.. لم يتم التعديل .. 
                <?php
                if (isset($error)) {
                    echo $error;
                }
                ?></div>

        </div>           
    <?php } else if ($msg == -2) {
        ?>
        <div class="box-body">
            <div class="alert alert-danger h4" role="alert"><strong>خطأ!</strong>..ذا الايميل موجود .. </div>

        </div>           
        <?php
    }
}


if (isset($_GET['user_id']) && intval($_GET['user_id'])) {

    $dataa = UserModel::getAllDatabyid($_GET['user_id']);
    if (!empty($dataa)) {
        $data = $dataa[0];
        ?>
        <section class="content-header">
            <h1>
                البروفايل
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> الصفحه الرئيسيه</a></li>
                <li><a href="#">الموظفين</a></li>
                <li class="active"> البروفايل</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="<?= HostName . DS . 'img' . DS . $data['user_image'] ?>"  alt="User profile picture">

                            <h3 class="profile-username text-center"><?= $data['user_name'] ?></h3>

                            <p class="text-muted text-center"><?= $data['user_job'] ?></p>


                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                    <!-- About Me Box -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">معلومات</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <strong><i class="fa fa-book margin-r-5"></i> الشركه</strong>

                            <?php
                            $info = CompanyModel::getAllDatabyid($data['company_id']);
                            if (!empty($info)) {
                                ?> 
                                <p class="text-muted">
                                    <?= $info[0]['company_name'] ?>
                                </p>
                            <?php } else { ?> 
                                <p class="text-muted">لايوجد شركه</p>

                            <?php } ?>

                            <hr>

                            <strong><i class="fa fa-map-marker margin-r-5"></i> العنوان</strong>

                            <p class="text-muted"><?= $data['user_address'] ?></p>

                            <hr>

                            <strong><i class="fa fa-pencil margin-r-5"></i> الصلاحيه</strong>

                            <p>

                                <span class="label label-success"><?= $data['role'] ?></span>

                            </p>
                            <hr>

                            <strong><i class="fa fa-map-marker margin-r-5"></i> التواصل</strong>

                            <p class="text-muted"><?= $data['user_email'] ?></p>
                            <p class="text-muted"><?= $data['user_phone'] ?></p>

                            <hr>

                            <strong><i class="fa fa-file-text-o margin-r-5"></i> معلومات اخري</strong>

                            <p><?= $data['user_other'] ?>.</p>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">

                            <li class="active"><a href="#timeline" data-toggle="tab">النشاطات</a></li>
                            <li><a href="#settings" data-toggle="tab">تعديل البيانات</a></li>

                        </ul>
                        <div class="tab-content">

                            <!-- /.tab-pane -->
                            <div class=" active tab-pane" id="timeline">

                                <?php
                                $dataact = ActivityModel::get_act_by_user_id_desc(intval($_GET['user_id']));
                                ?>
                                <!-- The timeline -->
                                <ul class="timeline timeline-inverse">
                                    <!-- timeline time label -->

                                    <li class="time-label">
                                        <span class="bg-red">
                                            <?= date('d/m/Y') ?>
                                        </span>
                                    </li>
                                    <!-- /.timeline-label -->
                                    <!-- timeline item -->
                                    <?php
                                    if (!empty($dataact)) {
                                        foreach ($dataact as $data_activity) {
                                            if ($data_activity['acc_id'] == $_SESSION['acc_id']) {
                                                if ($data_activity['type'] == 'email') {
                                                    ?>
                                                    <li>
                                                        <i class="fa fa-envelope bg-blue"></i>

                                                        <div class="timeline-item">
                                                            <span class="time"><i class="fa fa-clock-o"></i></span>

                                                            <h3 class="timeline-header"><a href="#"><?= $data_activity['user_name'] ?></a> قام بارسال ايميل</h3>

                                                            <div class="timeline-body">
                                                                <?= $data_activity['act_details'] ?>
                                                            </div>
                                                            <div class="timeline-footer">
                                                                <a class="btn btn-primary btn-xs" href="?rt=Activity/showone&act_id=<?= $data_activity['act_id'] ?>"> شاهد المزيد</a>
                                                                                             <?php if(isset($_SESSION['role']) && $_SESSION['role']=='manager'){?>

                                                                <a class="btn btn-danger btn-xs"    href="?rt=Activity/delete&act_id=<?= $data_activity['act_id'] ?>">احذف</a>
                                                                                             <?php } ?>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <!-- END timeline item -->
                                                <?php } elseif ($data_activity['type'] == 'contact') { ?>
                                                    <!-- timeline item -->
                                                    <li>
                                                        <i class="fa fa-user bg-aqua"></i>

                                                        <div class="timeline-item">
                                                            <span class="time"><i class="fa fa-clock-o"></i> <?= $data_activity['act_datetime'] ?></span>

                                                            <h3 class="timeline-header no-border"><a href="#"><?= $data_activity['user_name'] ?></a> <?= $data_activity['act_details'] ?>
                                                            </h3>
                                                            <div class="timeline-footer">
                                                                <a class="btn btn-primary btn-xs" href="?rt=Activity/showone&act_id=<?= $data_activity['act_id'] ?>"> شاهد المزيد</a>
                                                                                                <?php if(isset($_SESSION['role']) && $_SESSION['role']=='manager'){?>

                                                                <a class="btn btn-danger btn-xs"    href="?rt=Activity/delete&act_id=<?= $data_activity['act_id'] ?>">احذف</a>
                                                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <!-- END timeline item -->
                                                <?php } elseif ($data_activity['type'] == 'task') { ?>
                                                    <!-- timeline item -->
                                                    <li>
                                                        <i class="fa fa-tasks bg-yellow"></i>

                                                        <div class="timeline-item">
                                                            <span class="time"><i class="fa fa-clock-o"></i> <?= $data_activity['act_datetime'] ?></span>

                                                            <h3 class="timeline-header"><a href="#"><?= $data_activity['user_name'] ?></a>قام بتعديلات فالمهمات </h3>

                                                            <div class="timeline-body">
                                                                <?= $data_activity['act_details'] ?>
                                                            </div>
                                                            <div class="timeline-footer">
                                                                <a class="btn btn-primary btn-xs" href="?rt=Activity/showone&act_id=<?= $data_activity['act_id'] ?>"> شاهد المزيد</a>
                                                                                             <?php if(isset($_SESSION['role']) && $_SESSION['role']=='manager'){?>

                                                                <a class="btn btn-danger btn-xs"    href="?rt=Activity/delete&act_id=<?= $data_activity['act_id'] ?>">احذف</a>
                                                                                             <?php } ?>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <!-- END timeline item -->
                                                <?php } else { ?>
                                                    <!-- timeline item -->
                                                    <li>
                                                        <i class="fa fa-info bg-fuchsia"></i>

                                                        <div class="timeline-item">
                                                            <span class="time"><i class="fa fa-clock-o"></i> <?= $data_activity['act_datetime'] ?></span>

                                                            <h3 class="timeline-header no-border"><a href="#"><?= $data_activity['user_name'] ?></a> <?= $data_activity['act_details'] ?>
                                                            </h3>
                                                            <div class="timeline-footer">
                                                                <a class="btn btn-primary btn-xs" href="?rt=Activity/showone&act_id=<?= $data_activity['act_id'] ?>"> شاهد المزيد</a>
                                                                                         <?php if(isset($_SESSION['role']) && $_SESSION['role']=='manager'){?>

                                                                <a class="btn btn-danger btn-xs"    href="?rt=Activity/delete&act_id=<?= $data_activity['act_id'] ?>">احذف</a>
                                                                                         <?php } ?>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <!-- END timeline item -->
                                                    <?php
                                                }
                                            }
                                        }
                                    } else {
                                        ?>

                                        <li>
                                            <i class="fa fa-info bg-fuchsia"></i>

                                            <div class="timeline-item">
                                                <span class="time"><i class="fa fa-clock-o"></i> </span>

                                                <h3 class="timeline-header no-border">لايوجد نشاطات الان
                                                </h3>
                                            </div>
                                        </li>
                                    <?php }
                                    ?>
                                    <li>
                                        <i class="fa fa-clock-o bg-gray"></i>
                                    </li>
                                </ul>
                            </div>


                            <div class="tab-pane" id="settings" style="direction: rtl">
                                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                    <div class="form-group">

                                        <div class="col-sm-10">
                                            <input type="text" name="user_name" value="<?= $data['user_name'] ?>" class="form-control"  placeholder="Fname">
                                        </div>
                                        <label   class="col-sm-2 control-label">الاسم</label>

                                    </div>


                                    <div class="form-group">

                                        <div class="col-sm-10">
                                            <input type="email" name="user_email" value="<?= $data['user_email'] ?>" class="form-control"  placeholder="Email">
                                        </div>
                                        <label  class="col-sm-2 control-label">الايميل</label>
                                        <?php //  print_r($data);
                                        ?>
                                    </div>
                                    <div class="form-group">

                                        <div class="col-sm-10">
                                            <input type="password" name="user_password" value="<?= $data['user_password'] ?>" class="form-control"  placeholder="password">
                                        </div>
                                        <label  class="col-sm-2 control-label">كلمه السر</label>

                                    </div>
                                    <div class="form-group">

                                        <div class="col-sm-10">
                                            <input type="file" name="user_image"  class="form-control">
                                        </div>
                                        <label  class="col-sm-2 control-label">الصوره</label>

                                    </div>

                                    <div class="form-group">

                                        <div class="col-sm-10">

                                            <select name="company_id" class="form-control">
                                                <?php
                                                $dataa = CompanyModel::get_all_company_by_acc_id($_SESSION['acc_id']);
                                                if (!empty($dataa)) {
                                                    foreach ($dataa as $datauser) {
                                                        if ($datauser['company_id'] == $data['company_id']) {
                                                            ?>
                                                            <option selected value="<?= $datauser['company_id'] ?>"><?= $datauser['company_name'] ?></option>
                                                        <?php } else {
                                                            ?>
                                                            <option  value="<?= $datauser['company_id'] ?>"><?= $datauser['company_name'] ?></option>
                                                            <?php
                                                        }
                                                    }
                                                } else {
                                                    ?>
                                                    <option  value="0">لايوجد</option>

                                                <?php }
                                                ?>
                                            </select>

                                        </div>
                                        <label for="inputSkills" class="col-sm-2 control-label">الشركه</label>

                                    </div>


                                    <div class="form-group">

                                        <div class="col-sm-10">
                                            <input type="number" name="user_phone" value="<?= $data['user_phone'] ?>" class="form-control"  placeholder="Phone">
                                        </div>
                                        <label for="inputSkills" class="col-sm-2 control-label">التليفون</label>

                                    </div>
                                    <div class="form-group">

                                        <div class="col-sm-10">
                                            <input type="text" name="user_job" value="<?= $data['user_job'] ?>" class="form-control"  placeholder="Job">
                                        </div>
                                        <label for="inputSkills" class="col-sm-2 control-label">الوظيفه</label>

                                    </div>
                                    <div class="form-group">

                                        <div class="col-sm-10">
                                            <input type="text" name="user_address" value="<?= $data['user_address'] ?>" class="form-control"  placeholder="address">
                                        </div>
                                        <label for="inputSkills" class="col-sm-2 control-label">العنوان</label>

                                    </div>

                                    <div class="form-group">

                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="user_other" placeholder="Experience"><?= $data['user_other'] ?></textarea>
                                        </div>
                                        <label for="inputExperience" class="col-sm-2 control-label">معلومات اخري</label>

                                    </div>
                                    <input type="hidden" name="user_id" value="<?= $data['user_id'] ?>" class="form-control"  placeholder="Phone">
                                    <input type="hidden" name="user_date" value="<?= $data['user_date'] ?>" class="form-control"  placeholder="Phone">
                                    <?php
                                    if (isset($_SESSION['role']) && $_SESSION['role'] != 'manager') {
                                        if ($data['role'] == 'user') {
                                            ?>
                                            <input type="hidden" checked name="role" value="user"   >
                                        <?php } else { ?>
                                            <input type="hidden" checked name="role" value="admin"   >
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="form-group">

                                            <div class="col-sm-10">
                                                <?php if ($data['role'] == 'user') { ?>
                                                    <input type="radio" checked name="role" value="user"   >موظف
                                                    <input type="radio" name="role" value="admin"  >ادمن
                                                <?php } else { ?>
                                                    <input type="radio"  name="role" value="user"   >موظف
                                                    <input type="radio" checked name="role" value="admin"   >ادمن
                                                <?php } ?>
                                            </div>
                                            <label for="inputSkills" class="col-sm-2 control-label">الصلاحيه</label>

                                        </div>
                                    <?php } ?>
                                    <center>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <input type="submit" value="تعديل " class="btn btn-danger"/>
                                            </div>
                                        </div>
                                    </center>
                                </form>
                            </div>
                            <!-- /.tab-pane -->


                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
                <div style="margin-top: 40%"></div>
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
        <?php
    }
} else {
    ?>
    <div class="box-body">
        <div class="alert alert-danger h4" role="alert"><strong>خطا!</strong>..الموظف ليس موجود !! ..</div>
        <div style="margin-top: 60%"></div>
    </div>
<?php }
?>