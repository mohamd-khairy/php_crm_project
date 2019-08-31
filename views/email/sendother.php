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
        }
    }
    ?>


    <section class="content-header">
        <h1>ارسال ايميل</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> الصفحه الرئيسيه</a></li>
            <li class="active">الايميلات</li>
        </ol>
    </section>


    <div class="box-body">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">ارسل رساله جديده</h3>
                </div>
                <!-- /.box-header -->
                <form action="?rt=Email/sendother" method="post" enctype="multipart/form-data" id="myForm">
                    <div class="box-body">
                        <div class="form-group">
                            <input class="form-control" id="email" type="email" name="email" placeholder="الي:">
                        </div>
                        <div class="form-group">
                            <input class="form-control" id="content" type="text" name="email_content" placeholder="المحتوي:">
                        </div>
                        <div class="form-group">
                            <div class="btn btn-default btn-file">
                                <i class="fa fa-paperclip"></i> مرفق
                                <input type="file" name="email_attach">
                            </div>
                            <p class="help-block">حد اقصي. 32ميجا</p>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="pull-right">
                            <button type="button" class="btn btn-primary" onclick="show();"><i class="fa fa-envelope-o"  ></i> ارسل</button>
                        </div>
                        <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> امسح</button>
                    </div>
                    <!-- /.box-footer -->
                </form>

                <!-- /.spinner loadin -->
                <div id="spinner" style="display: none">
                    <img id="img-spinner" src="img/spinner.gif" alt="loading"/>
                </div>
                <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
                <script src="//code.jquery.com/jquery-1.9.1.js"></script>
                <script type="text/javascript">
                                function show() {
                                    if ($("#email").val() == "" && $("#content").val() == "") {
                                        alert("تأكد ان الايميل والمحتوي غير فارغين ");
                                    } else if ($("#email").val() == "" || $("#content").val() == "") {
                                        alert("تأكد ان الايميل اوالمحتوي غير فارغين ");

                                    } else {
                                        $("#spinner").show();
                                        $("#myForm").submit();
                                    }
                                    return false;
                                }
                </script>
            </div>
            <!-- /. box -->
        </div>

        <!-- /.box-body -->
    </div>
    <div style="margin-top: 50%"></div>
</div>
