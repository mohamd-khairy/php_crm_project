<div class="box-body">

    <?php
    if (isset($msg) || isset($error)) {
        if ($msg == 1) {
            ?>
            <div class="box-body">
                <div class="alert alert-success h5" role="alert">تمت الارسال بنجاح...</div>

            </div>
        <?php } else if ($msg == -1) { ?>
            <div class="box-body">
                <div class="alert alert-danger h4" role="alert"><strong>خطأ!</strong>..لم يتم الارسال.. <?php
                    if (isset($error)) {
                        echo $error;
                    }
                    ?></div>

            </div>           
        <?php } else if ($msg == -2) {
            ?>
            <div class="box-body">
                <div class="alert alert-danger h4" role="alert"><strong>خطا!</strong>..هذا الايميل بالفعل موجود..!! ?></div>

            </div> 
            <?php
        } else if ($msg == 3) {
            ?>
            <div class="box-body">
                <div class="alert alert-warning h4" role="alert"><strong>اكمل العمليه!</strong>..أرسل المهمه ..!! ?></div>

            </div> 
            <?php
        }
    }
    ?>


    <section class="content-header">
        <h1> ارسال ايميل</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> الصفحه الرئيسيه</a></li>
            <li class="active">العملاء</li>
            <li class="active">ارسل ايميل</li>
        </ol>
    </section>

    <div class="box box-warning">
        <div class="box-header with-border has-error">
            <h3 class="box-title" style="margin-right: 70%"> </h3>
        </div>

        <div class="box-body" style="direction: rtl">
            <form action="?rt=Email/send" method="post" enctype="multipart/form-data" id="myForm">

                <?php $data = ContactModel::getAllData(); ?>
                <div class="form-group has-success" style="margin-left: 15%; margin-right: 25%">
                    <label class="control-label" for="inputError"><i class="fa fa-rss"></i> العملاء:</label>
                    <select name="email" class="form-control" id="email">
                        <?php
                        if (!empty($data)) {
                            foreach ($data as $con) {
                                if ($con['acc_id'] == $_SESSION['acc_id']) {
                                    ?>

                                    <option  value="<?= $con['contact_email'] ?>"><?= $con['contact_name'] ?></option>
                                    <?php
                                }
                            }
                        } else {
                            ?>
                            <option value="0">لا يوجد</option>
                        <?php } ?>
                    </select>
                    <span class="help-block">اختر عميل ...</span>
                </div>

                <div class="form-group has-error" style="margin-left: 15%; margin-right: 25%">
                    <label class="control-label" for="inputError"><i class="fa fa-rss"></i> محتوي الايميل:</label>
                    <input type="text" name="email_content" id="content" class="form-control"  placeholder="ادخل ...">
                    <span class="help-block">ادخل محتوي الايميل  ...</span>
                </div>
                <div class="form-group has-warning" style="margin-left: 15%; margin-right: 25%">
                    <label class="control-label" for="inputError"><i class="fa fa-file"></i> المرفق:</label>
                    <input type="file" name="email_attach" class="form-control"  >
                    <span class="help-block">اختار مرفق مع الايميل ...</span>
                </div>
                <center>
                    <div style="margin-left: 30%" >
                        <input  type="button" onclick="show();"  value="ارسال" style="width: 150px" class="btn  btn-success btn-lg">
                        <button  type="reset" style="width: 150px"class="btn  btn-success btn-lg">امسح</button>
                    </div>
                </center>
            </form>

            <!-- /.spinner loadin -->
            <div id="spinner" style="display: none">
                <img id="img-spinner" src="img/spinner.gif" alt="loading"/>
            </div>
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
            <script src="//code.jquery.com/jquery-1.9.1.js"></script>
            <script type="text/javascript">
                            function show() {
                                if ($("#email").val() == "0" && $("#content").val() == "") {
                                    alert("تأكد ان الايميل والمحتوي غير فارغين ");
                                } else if ($("#email").val() == "0" || $("#content").val() == "") {
                                    alert("تأكد ان الايميل اوالمحتوي غير فارغين ");

                                } else {
                                    $("#spinner").show();
                                    $("#myForm").submit();
                                }
                                return false;
                            }
            </script>
            <div style="margin-top: 30%"></div>

        </div>
        <!-- /.box-body -->

    </div>
</div>
