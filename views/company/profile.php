<!-- Content Header (Page header) -->

<?php
if (isset($msg) || isset($error)) {
    if ($msg == 1) {
        ?>
        <div class="box-body" >
            <div class="alert alert-success h5" role="alert">تم التعديل بنجاح...</div></div>
    <?php } else if ($msg == -1) { ?>
        <div class="box-body" >    <div class="alert alert-danger h4" role="alert"><strong>خطا!</strong>..لم يتم التعديل..  <?php
                if (isset($error)) {
                    echo $error;
                }
                ?></div>
        </div>       
        <?php
    }
}



if (isset($_GET['company_id']) && intval($_GET['company_id'])) {

    $data = CompanyModel::getAllDatabyid($_GET['company_id'])[0];
    if (empty($data)) {
        ?>

        <div class="box-body">
            <div class="alert alert-danger h4" role="alert"><strong>أسف!</strong>..]يوجد شئ خطأ !! ..</div>
            <div style="margin-top: 60%"></div>
        </div>

    <?php } else { ?>
        <div class="box-body">
            <section class="content-header">
                <h1>
                    بيانات الشركه
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> الصفحه الرئيسيه</a></li>
                    <li><a href="#">الشركات</a></li>
                    <li class="active"> البروفايل</li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content" >

                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="box box-primary">
                            <div class="box-body box-profile">
                                <img class="profile-user-img img-responsive img-circle" src="<?= HostName . DS . 'img' . DS . $data['company_image'] ?>"  alt="User profile picture">

                                <h3 class="profile-username text-center"><?= $data['company_name'] ?></h3>

                                <p class="text-muted text-center">Make Your Future</p>

                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                      <a class="pull-right"><?= $data['company_address'] ?> </a><b>العنوان:</b>  
                                    </li>
                                    <li class="list-group-item">
                                        <a class="pull-right"><?= $data['company_url'] ?></a><b>الموقع:</b>
                                    </li>
                                    <li class="list-group-item">
                                        <a class="pull-right"><?= $data['company_phone'] ?></a><b>الموبايل:</b>
                                    </li>
                                    <li class="list-group-item">
                                        <a class="pull-right"><?= $data['company_date'] ?></a>  <b>  تاريخ البدايه:</b>
                                    </li>

                                </ul>

                                <a href="index.php?rt=Company/show" class="btn btn-primary btn-block"><b>كل الشركات</b></a>
                            </div>
                            <!-- /.box-body -->
                        </div>

                    </div>
                    <!-- /.col -->
                    <div class="col-md-9" style="direction: rtl">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">

                                <li><a href="#settings" data-toggle="tab">تعديل البيانات</a></li>
                            </ul>


                            <div class="box-body">


                                <form class="form-horizontal" method="post"  enctype="multipart/form-data">
                                    <div class="form-group">

                                        <div class="col-sm-10">
                                            <input type="text" name="company_name" value="<?= $data['company_name'] ?>" class="form-control"  placeholder="name">
                                        </div>
                                        <label for="inputName"  class="col-sm-2 control-label">الاسم:</label>

                                    </div>


                                    <div class="form-group">

                                        <div class="col-sm-10">
                                            <input type="url" name="company_url" value="<?= $data['company_url'] ?>" class="form-control"  placeholder="url">
                                        </div>
                                        <label for="inputEmail" class="col-sm-2 control-label">اللينك:</label>

                                    </div>

                                    <div class="form-group">

                                        <div class="col-sm-10">
                                            <input type="file" name="company_image"  class="form-control">
                                        </div>
                                        <label for="inputEmail" class="col-sm-2 control-label">الصوره:</label>

                                    </div>

                                    <div class="form-group">

                                        <div class="col-sm-10">
                                            <input type="tel" name="company_phone" value="<?= $data['company_phone'] ?>" class="form-control"  placeholder="Phone">
                                        </div>
                                        <label for="inputSkills" class="col-sm-2 control-label">الموبايل:</label>

                                    </div>

                                    <div class="form-group">

                                        <div class="col-sm-10">
                                            <input type="text" name="company_address" value="<?= $data['company_address'] ?>" class="form-control"  placeholder="address">
                                        </div>
                                        <label for="inputSkills" class="col-sm-2 control-label">العنوان:</label>

                                    </div>
                                    <input type="hidden" name="company_id" value="<?= $data['company_id'] ?>" class="form-control"  placeholder="Phone">

                                    <input type="hidden" name="company_date" value="<?= $data['company_date'] ?>" class="form-control"  placeholder="Phone">
                                    <center>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <input type="submit" value="تعديل " class="btn btn-danger"/>
                                        </div>
                                    </div>
                                    </center>
                                </form>

                                <!-- /.tab-pane -->

                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                    <!-- /.col -->

                </div>
                <!-- /.row -->

            </section>
            <div style="margin-top: 40%"></div>
        </div>
        <!-- /.content -->
        <?php
    }
} else {
    ?>

    <div class="box-body">
        <div class="alert alert-danger h4" role="alert"><strong>خطأ!</strong>..بوجد شئ غير صحيح !! ..</div>
        <div style="margin-top: 60%"></div>
    </div>

    <?php
}
?>