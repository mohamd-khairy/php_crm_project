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



if (isset($_GET['acc_id']) && intval($_GET['acc_id'])) {

    $dataa = AccountModel::getAllDatabyid($_GET['acc_id']);
    if (!empty($dataa)) {
        $data = $dataa[0];
        ?>
        <section class="content-header">
            <h1>
                الصفحه الشخصيه
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> الصفحه الرئيسيه</a></li>
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
                            <img class="profile-user-img img-responsive img-circle" src="<?= HostName . DS . 'img' . DS . $data['acc_image'] ?>"  alt="User profile picture">

                            <h3 class="profile-username text-center"><?= $data['acc_name'] ?></h3>

                            <p class="text-muted text-center">مدير</p>


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


                            <strong><i class="fa fa-map-marker margin-r-5"></i> العنوان</strong>

                            <p class="text-muted"><?= $data['acc_city'] ?></p>

                            <hr>

                            <strong><i class="fa fa-pencil margin-r-5"></i> الصلاحيه</strong>

                            <p>

                                <span class="label label-success"><?= $data['role'] ?></span>

                            </p>
                            <hr>

                            <strong><i class="fa fa-map-marker margin-r-5"></i> التواصل</strong>

                            <p class="text-muted"><?= $data['acc_email'] ?></p>
                            <p class="text-muted"><?= $data['acc_phone'] ?></p>

                            <hr>


                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">

                            <li><a href="#settings" data-toggle="tab">تعديل البيانات</a></li>

                        </ul>
                        <div class="tab-content">



                            <div class="active tab-pane" id="settings" style="direction: rtl">
                                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                    <div class="form-group" >

                                        <div class="col-sm-10">
                                            <input type="text" name="acc_name" value="<?= $data['acc_name'] ?>" class="form-control"  placeholder="Fname">

                                        </div>
                                        <label   class="col-sm-2 control-label">الاسم:</label>

                                    </div>


                                    <div class="form-group">

                                        <div class="col-sm-10">
                                            <input type="email" name="acc_email" value="<?= $data['acc_email'] ?>" class="form-control"  placeholder="Email">
                                        </div>
                                        <label  class="col-sm-2 control-label">الايميل:</label>

                                    </div>
                                    <div class="form-group">

                                        <div class="col-sm-10">
                                            <input type="password" name="acc_password" value="<?= $data['acc_password'] ?>" class="form-control"  placeholder="password">
                                        </div>
                                        <label  class="col-sm-2 control-label">كلمه السر:</label>

                                    </div>
                                    <div class="form-group">

                                        <div class="col-sm-10">
                                            <input type="file" name="acc_image"  class="form-control">
                                        </div>
                                        <label  class="col-sm-2 control-label">الصوره:</label>

                                    </div>


                                    <div class="form-group">

                                        <div class="col-sm-10">
                                            <input type="number" name="acc_phone" value="<?= $data['acc_phone'] ?>" class="form-control"  placeholder="Phone">
                                        </div>
                                        <label for="inputSkills" class="col-sm-2 control-label">الموبايل:</label>

                                    </div>

                                    <div class="form-group">

                                        <div class="col-sm-10">
                                            <input type="text" name="acc_city" value="<?= $data['acc_city'] ?>" class="form-control"  placeholder="address">
                                        </div>
                                        <label for="inputSkills" class="col-sm-2 control-label">العنوان :</label>

                                    </div>
                                    <input type="hidden" name="acc_id" value="<?= $data['acc_id'] ?>" class="form-control"  placeholder="Phone">
                                    <input type="hidden" name="acc_start_date" value="<?= $data['acc_start_date'] ?>" class="form-control"  placeholder="Phone">
                                    <input type="hidden" name="role" value="<?= $data['role'] ?>" class="form-control"  placeholder="Phone">
                                    <center>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <input type="submit" value="Submit " class="btn btn-danger"/>
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
        <div class="alert alert-danger h4" role="alert"><strong>SORRY!</strong>..This Owner not founded !! ..</div>
        <div style="margin-top: 60%"></div>
    </div>
<?php }
?>