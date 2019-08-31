<!-- Content Header (Page header) -->
<div class="box-body">
    <div id="d1"></div>
</div>
<?php
$dataa = ContactModel::getAllDatabyid($_GET['contact_id']);

if (!empty($dataa)) {
    $data = $dataa[0];
    ?>
    <section class="content-header">
        <h1>
            البروفايل
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> الصفحه الرئيسيه</a></li>
            <li><a href="#">كل العملاء</a></li>
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
                        <img class="profile-user-img img-responsive img-circle" src="<?= HostName . DS . 'img' . DS . 'avatar5.png' ?>" alt="User profile picture">

                        <h3 class="profile-username text-center"><?= $data['contact_name'] ?></h3>

                        <p class="text-muted text-center"><?= $data['contact_job'] ?></p>


                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- About Me Box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">بيانات</h3>
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
                            <p class="text-muted">لايوجد شركه الان  </p>

                        <?php } ?>


                        <hr>

                        <strong><i class="fa fa-map-marker margin-r-5"></i> العنوان</strong>

                        <p class="text-muted"><?= $data['contact_address'] ?></p>

                        <hr>


                        <strong><i class="fa fa-map-marker margin-r-5"></i> التواصل</strong>

                        <p class="text-muted"><?= $data['contact_email'] ?></p>
                        <p class="text-muted"><?= $data['contact_phone'] ?></p>

                        <hr>

                        <strong><i class="fa fa-file-text-o margin-r-5"></i> معلومات اخري</strong>

                        <p><?= $data['contact_other'] ?>.</p>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9" style="direction: rtl">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li><a href="#settings" data-toggle="tab">تعديل البيانات</a></li>

                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="settings">
                            <form class="form-horizontal" id="myForm" method="get">
                                <div class="form-group">

                                    <div class="col-sm-10">
                                        <input type="text" name="contact_name" id="t1" value="<?= $data['contact_name'] ?>" class="form-control"  placeholder="name">
                                    </div>
                                    <label for="inputName"  class="col-sm-2 control-label">الاسم:</label>

                                </div>


                                <div class="form-group">

                                    <div class="col-sm-10">
                                        <input type="email" id="t2" name="contact_email" value="<?= $data['contact_email'] ?>" class="form-control"  placeholder="Email">
                                    </div>
                                    <label for="inputEmail" class="col-sm-2 control-label">الايميل:</label>

                                </div>

                                <div class="form-group">

                                    <div class="col-sm-10">
                                        <?php
                                        $dataa = CompanyModel::get_all_company_by_acc_id($_SESSION['acc_id']);
                                        //  print_r($dataa);
                                        ?>
                                        <select name="company_id" id="t3" class="form-control">
                                            <?php
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
                                                <option value="0">لايوجد</option>
                                            <?php }
                                            ?>

                                        </select>   
                                    </div>
                                    <label for="inputSkills" class="col-sm-2 control-label">الشركه:</label>

                                </div>


                                <div class="form-group">

                                    <div class="col-sm-10">
                                        <input type="tel" name="contact_phone" id="t4" value="<?= $data['contact_phone'] ?>" class="form-control"  placeholder="Phone">
                                    </div>
                                    <label for="inputSkills" class="col-sm-2 control-label">التليفون:</label>

                                </div>
                                <div class="form-group">

                                    <div class="col-sm-10">
                                        <input type="text" name="contact_job" id="t5" value="<?= $data['contact_job'] ?>" class="form-control"  placeholder="Job">
                                    </div>
                                    <label for="inputSkills" class="col-sm-2 control-label">الوظيفه:</label>

                                </div>
                                <div class="form-group">

                                    <div class="col-sm-10">
                                        <input type="text" name="contact_address" id="t6" value="<?= $data['contact_address'] ?>" class="form-control"  placeholder="address">
                                    </div>
                                    <label for="inputSkills" class="col-sm-2 control-label">العنوان:</label>

                                </div>

                                <div class="form-group">

                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="contact_other" id="t7" placeholder="Experience"><?= $data['contact_other'] ?></textarea>
                                    </div>
                                    <label for="inputExperience" class="col-sm-2 control-label">معلومات اخري:</label>

                                </div>
                                <input type="hidden" name="contact_id" id="t8" value="<?= $data['contact_id'] ?>" class="form-control"  placeholder="Phone">
                                <input type="hidden" name="contact_date" id="t9" value="<?= $data['contact_date'] ?>" class="form-control"  placeholder="Phone">
                                <center>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="button" onclick="aa();" value="تعديل " class="btn btn-danger"/>
                                    </div>
                                </div>
                                </center>
                            </form>
                            <script  type="text/javascript">
                                function aa() {
                                    var xmlhttp = new XMLHttpRequest();
                                    xmlhttp.open("GET", "?rt=Contact/profileajax&contact_name="
                                            + document.getElementById("t1").value + "&contact_email="
                                            + document.getElementById("t2").value + "&company_id="
                                            + document.getElementById("t3").value + "&contact_phone="
                                            + document.getElementById("t4").value + "&contact_job="
                                            + document.getElementById("t5").value + "&contact_address="
                                            + document.getElementById("t6").value + "&contact_other="
                                            + document.getElementById("t7").value + "&contact_id="
                                            + document.getElementById("t8").value + "&contact_date="
                                            + document.getElementById("t9").value, false);
                                    xmlhttp.send(null);
                                    document.getElementById('d1').innerHTML = xmlhttp.responseText;
                                    var form = document.getElementById("myForm");
                                    form.reset();
                           //                        setTimeout(function () {
                           //                            $('#d2').fadeOut('fast');
                           //                        }, 3000);
                                }
                            </script>
                        </div>
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
<?php } else { ?>
    <div class="box-body">
        <div class="alert alert-danger h4" role="alert"><strong>خطأ!</strong>..العميل غير موجود ..</div>
        <div style="margin-top: 60%"></div>
    </div>
<?php }
?>
<!-- /.content -->