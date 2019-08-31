<!-- /.box-header -->
<div class="box-body">
    <div id="d1"></div>
    <div class="col-md-12" style="direction: rtl">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title" style="text-align: right">اضف عمـيل</h3>
            </div>
            <div class="box-body ">
                <form id="myForm" method="get" >

                    <div class="form-group">
                        <label>الاســم:</label>

                        <div class="input-group">
                            <div class="input-group-addon" >
                                <i class="fa fa-user"></i>
                            </div>
                            <input type="text" class="form-control" id="t1" name="contact_name" placeholder="اسم العميل...">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <label>الايميل:</label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <input type="email" class="form-control" id="t2" name="contact_email" placeholder="الايميل...">
                        </div>
                        <!-- /.input group -->
                    </div>

                    <div class="form-group">
                        <label>الموبايل:</label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <input type="tel" class="form-control" id="t3" name="contact_phone" placeholder="الموبايل...">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <label>العنوان:</label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-home"></i>
                            </div>
                            <input type="text" class="form-control" id="t4" name="contact_address" placeholder="العنوان...">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <label>الشركه:</label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <select name='company_id' class="form-control" id="t5">
                                <?php
                                $dataa = CompanyModel::get_all_company_by_acc_id($_SESSION['acc_id']);
                                if (!empty($dataa)) {
                                    foreach ($dataa as $data) {
                                        ?>
                                        <option value="<?= $data['company_id'] ?>"><?= $data['company_name'] ?></option>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <option value="0">No Company</option>

                                <?php }
                                ?> 
                            </select>
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->

                    <div class="form-group">
                        <label> الوظيفه:</label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-tasks"></i>
                            </div>
                            <input type="text" class="form-control" id="t6" name="contact_job" placeholder=" الوظيفه...">
                        </div>
                        <!-- /.input group -->
                    </div>

                    <!-- /.form group -->
                    <div class="form-group">
                        <label> معلومات اخري:</label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-info"></i>
                            </div>
                            <input type="text" class="form-control" id="t7" name="contact_other" placeholder=" معلومات اخري...">
                        </div>
                        <!-- /.input group -->
                    </div>


                    <!-- /.form group -->
                    <div class="form-group">
                        <center>
                            <div class="col-sm-offset-2 col-sm-10">
                                <input type="button" onclick="aa();" value="أضف " class="btn btn-danger"/>
                            </div>
                        </center>
                    </div>
                </form>
                <script  type="text/javascript">
                    function aa() {
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.open("GET", "?rt=Contact/addajax&contact_name="
                                + document.getElementById("t1").value + "&contact_email="
                                + document.getElementById("t2").value + "&contact_phone="
                                + document.getElementById("t3").value + "&contact_address="
                                + document.getElementById("t4").value + "&company_id="
                                + document.getElementById("t5").value + "&contact_job="
                                + document.getElementById("t6").value + "&contact_other="
                                + document.getElementById("t7").value, false);
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
            <!-- /.box-body -->
        </div>

    </div>

    <div style="margin-top: 30%"></div>

</div>
<!-- /.box-body -->




