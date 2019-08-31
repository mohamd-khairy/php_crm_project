
<div class="box-body" id="d1">
</div>
<?php
if (isset($msg)) {
    if ($msg == 3) {
        ?>
        <div class="box-body">
            <div class="alert alert-warning h4" id="d2" role="alert"><strong>اكمل العمليه!</strong>.. أضف المكالمه ..!! ?></div>
        </div> 
        <?php
    }
}
?>

<div class="box-body">
    <div class="box box-warning">
        <div class="box-header with-border has-error">
            <h3 class="box-title" style="margin-right: 70% ">مكامله جديده</h3>
        </div>

        <div class="box-body">

            <div class=" col-sm-11">
                <div class="box box-danger" style="direction: rtl">
                    <div class="box-header with-border has-error">
                        <h3 class="box-title" style="margin-right: 70%">اضف مكالمه</h3>
                    </div>
                    <form action="" method="get" id="myForm">

                        <?php $data = ContactModel::getAllData_by_acc_id($_SESSION['acc_id']); ?>
                        <div class="form-group has-success" style="margin-left: 15%; margin-right: 25%">
                            <label class="control-label" for="inputError"><i class="fa fa-rss"></i> العميل:</label>
                            <select name="contact_id" class="form-control" id="t1">
                                <?php foreach ($data as $con) { ?>
                                    <option  value="<?= $con['contact_id'] ?>"><?= $con['contact_name'] ?></option>
                                <?php } ?>
                            </select>
                            <span class="help-block">اختر عميل  ...</span>
                        </div>

                        <div class="form-group has-error" style="margin-left: 15%; margin-right: 25%">
                            <label class="control-label" for="inputError"><i class="fa fa-rss"></i> تفاصيل المكالمه:</label>
                            <input type="text" name="call_title" id="t2" class="form-control"  placeholder="التفاصيل ...">
                            <span class="help-block">اكتب تفاصيل المكالمه ...</span>
                        </div>
                        <center>
                            <div style="margin-left: 30%" >
                                <input  type="button" onclick="aa();"  value="اضف" style="width: 150px" class="btn  btn-success btn-lg">
                                <button  type="reset" style="width: 150px"class="btn  btn-success btn-lg">مسح</button>
                            </div>
                        </center>
                    </form>
                    <script  type="text/javascript">
                        function aa() {
                            var xmlhttp = new XMLHttpRequest();
                            xmlhttp.open("GET", "?rt=Call/addajax&contact_id="
                                    + document.getElementById("t1").value + "&call_title="
                                    + document.getElementById("t2").value, false);
                            xmlhttp.send(null);
                            document.getElementById('d1').innerHTML = xmlhttp.responseText;
                            var form = document.getElementById("myForm");
                            form.reset();
                            setTimeout(function () {
                                $('#d2').fadeOut('fast');
                            }, 3000);
                        }
                    </script>
                    <div style="margin-top: 40%"></div>
                </div>             
            </div>
            <div style="margin-top: 80%"></div>
        </div>
        <!-- /.box-body -->
    </div>
</div>



