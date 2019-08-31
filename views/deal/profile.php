<div class="box-body">
    <div id="d1"></div>
</div>
<section class="content-header" >
    <h1>
        الصفقه
    </h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> الصفحه الرئيسيه</a></li>
        <li class="active">الصفقات</li>
        <li class="active">معلومات الصفقه</li>

    </ol>

</section>



<?php
if (isset($_GET['deal_id']) && intval($_GET['deal_id'])) {

    $data = DealModel:: getAllDatabyid($_GET['deal_id'])[0];
    if (empty($data)) {
        ?> 
        <div class="box-body">
            <div class="alert alert-danger h4" role="alert"><strong>خطأ!</strong>..يوجد شئ غير صحيح !! ..</div>
            <div style="margin-top: 60%"></div>
        </div>
    <?php } else { ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <section class="content" >
                        <!-- /.col -->
                        <div class="col-md-12">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#timeline" data-toggle="tab">الصفقه</a></li>
                                    <li><a href="#settings" data-toggle="tab">تعديل</a></li>
                                </ul>
                                <div class="tab-content">
                                    <!-- /.tab-pane -->
                                    <div class=" active tab-pane" id="timeline">
                                        <ul class="nav nav-pills nav-stacked " >

                                            <div class="col-sm-12">

                                                <!-- Profile Image -->
                                                <div class="box box-primary">
                                                    <div class="box-body box-profile">

                                                        <h3 class="profile-username text-center"><?= $data['deal_name'] ?></h3>

                                                        <ul class="list-group list-group-unbordered">
                                                            
                                                                <li class="list-group-item" style="margin-top: 1% ">
                                                                    <a class="pull-right">الطرف الاول</a>
                                                                    <b ><?= $data['deal_user'] ?></b> 
                                                                </li>  
                                                            <?php // }
                                                            ?>
                                                            <li class="list-group-item" style="margin-top: 1% ">
                                                                <a class="pull-right">قيمه الصفقه</a>
                                                                <b ><?= $data['deal_value'] ?></b> 
                                                            </li>
                                                            <li class="list-group-item" style="margin-top: 1% ">
                                                                <a class="pull-right">تاريخ بدايه الصفقه</a>
                                                                <b ><?= $data['deal_start_date'] ?></b>
                                                            </li>
                                                            <li class="list-group-item" style="margin-top: 1% ">
                                                                <a class="pull-right">تاريخ نهايه الصفقه</a>
                                                                <b ><?= $data['deal_end_date'] ?></b>
                                                            </li>


                                                        </ul>

                                                        <a href="index.php?rt=deal/show" class="btn btn-danger btn-block" style="width: 15%;margin-left: 50%" >كل الصفقات </a>
                                                    </div>

                                                    <!-- /.box-body -->
                                                </div>
                                                <!-- /.box -->

                                                <!-- /.box -->
                                            </div>

                                        </ul>

                                    </div>

                                    <div class="tab-pane" id="settings" style="direction: rtl">
                                        <ul class="nav nav-pills nav-stacked " style="direction: rtl;margin-top: 1% ">

                                            <form class="form-horizontal" method="get" id="myForm" >

                                                <div class="form-group">
                                                    <?php if ($data['contact_id'] != 0 && $data['user_id'] == 0) {
                                                        ?>
                                                        <input type="hidden" id="t-1" name="user_id" value="0"/>
                                                        <input type="hidden"  id="t1" name="deal_user" value="0" class="form-control" >

                                                        <div class="col-sm-10">

                                                            <select name="contact_id" class="form-control" id="t0">
                                                                <?php
                                                                $contact = ContactModel::getAllData_by_acc_id($_SESSION['acc_id']);
                                                                foreach ($contact as $con) {
                                                                    if ($data['contact_id'] == $con['contact_id']) {
                                                                        ?>
                                                                        <option selected value="<?= $con['contact_id'] ?>"><?= $con['contact_name'] ?></option>

                                                                    <?php } else {
                                                                        ?>
                                                                        <option value="<?= $con['contact_id'] ?>"><?= $con['contact_name'] ?></option>

                                                                        <?php
                                                                    }
                                                                }
                                                                ?>

                                                            </select>
                                                        </div>
                                                    <?php } elseif ($data['contact_id'] == 0 && $data['user_id'] != 0) {
                                                        ?>
                                                        <div class="col-sm-10">
                                                            <input type="hidden" id="t0" name="contact_id" value="0"/>
                                                            <input type="hidden"  id="t1" name="deal_user" value="0" class="form-control" >

                                                            <select name="user_id" class="form-control" id="t-1">
                                                                <?php
                                                                $user = UserModel::getAllData_by_acc_id($_SESSION['acc_id']);
                                                                foreach ($user as $con) {
                                                                    if ($data['user_id'] == $con['user_id']) { // hidden not added
                                                                        ?>
                                                                        <option selected value="<?= $con['user_id'] ?>"><?= $con['user_name'] ?></option>

                                                                    <?php } else { // hidden not added
                                                                        ?>
                                                                        <option  value="<?= $con['user_id'] ?>"><?= $con['user_name'] ?></option>

                                                                        <?php
                                                                    }
                                                                }
                                                                ?>

                                                            </select>
                                                        </div>
                                                    <?php } else {
                                                        ?>
                                                        <div class="col-sm-10">
                                                            <input type="hidden"  id="t-1" name="user_id" value="0" >
                                                            <input type="hidden"  id="t0" name="contact_id" value="0"/>
                                                            <input type="text"  id="t1" name="deal_user" value="<?= $data['deal_user'] ?>" class="form-control" >

                                                        </div>                                  

                                                    <?php } ?>
                                                    <label for="inputEmail" class="col-sm-2 control-label">الطرف الاول:</label>

                                                </div>

                                                <div class="form-group">

                                                    <div class="col-sm-10">
                                                        <input type="text" name="deal_name" id="t2" value="<?= $data['deal_name'] ?>" class="form-control"  placeholder="company">
                                                    </div>
                                                    <label for="inputSkills" class="col-sm-2 control-label">محتوي الصفقه</label>

                                                </div>

                                                <div class="form-group">

                                                    <div class="col-sm-10">
                                                        <input type="text" name="deal_value" id="t3" value="<?= $data['deal_value'] ?>" class="form-control"  placeholder="Skills">
                                                    </div>
                                                    <label for="inputSkills" class="col-sm-2 control-label">قيمه الصفقه</label>

                                                </div>

                                                <div class="form-group">

                                                    <div class="col-sm-10">
                                                        <input type="date" name="deal_start_date" id="t4" value="<?= $data['deal_start_date'] ?>" class="form-control"  placeholder="Phone">
                                                    </div>
                                                    <label for="inputSkills" class="col-sm-2 control-label">تاريخ بدايه الصفقه</label>

                                                </div>
                                                <div class="form-group">

                                                    <div class="col-sm-10">
                                                        <input type="date" name="deal_end_date" id="t5" value="<?= $data['deal_end_date'] ?>" class="form-control"  placeholder="Phone">
                                                    </div>
                                                    <label for="inputSkills" class="col-sm-2 control-label">تاريخ نهايه الصفقه</label>

                                                </div>

                                                <div class="form-group">

                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" name="other" id="t6" placeholder="Experience"><?= $data['other'] ?></textarea>
                                                    </div>
                                                    <label for="inputExperience" class="col-sm-2 control-label">معلومات اخري</label>

                                                </div>

                                                <input type="hidden" name="deal_id" id="t7" value="<?= $data['deal_id'] ?>" class="form-control"  placeholder="Phone">
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
                                                    xmlhttp.open("GET",
                                                            "?rt=Deal/profileajax&user_id="+document.getElementById("t-1").value
                                                            + "&contact_id=" + document.getElementById("t0").value
                                                            + "&deal_user=" + document.getElementById("t1").value
                                                            + "&deal_name=" + document.getElementById("t2").value
                                                            + "&deal_value=" + document.getElementById("t3").value
                                                            + "&deal_start_date=" + document.getElementById("t4").value
                                                            + "&deal_end_date=" + document.getElementById("t5").value
                                                            + "&other=" + document.getElementById("t6").value
                                                            + "&deal_id=" + document.getElementById("t7").value, false);
                                                    xmlhttp.send(null);
                                                    document.getElementById('d1').innerHTML = xmlhttp.responseText;
                                                    var form = document.getElementById("myForm");
                                                    form.reset();
                                                    //                        setTimeout(function () {
                                                    //                            $('#d2').fadeOut('fast');
                                                    //                        }, 3000);
                                                }
                                            </script>
                                        </ul>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div>
                            <!-- /.nav-tabs-custom -->
                        </div>
                        <div style="margin-top: 50%"></div>
                        <!-- /.col -->
                    </section>

                </div>
            </div>
        </div>
        <!-- /.row -->




        <?php
    }
} else {
    ?>

    <div class="box-body">
        <div class="alert alert-danger h4" role="alert"><strong>SORRY!</strong>..Some thing is Fault !! ..</div>
        <div style="margin-top: 60%"></div>
    </div>

    <?php
}
?>

