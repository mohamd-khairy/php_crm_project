<!-- /.box-header -->

    <?php
if (isset($msg) || isset($error)) {
    if ($msg == 1) {
        ?>
        <div class="box-body">
            <div class="alert alert-success h5" role="alert">تمت الاضافه بنجاح...</div>

        </div>
    <?php } else if ($msg == -1) { ?>
        <div class="box-body">
            <div class="alert alert-danger h4" role="alert"><strong>خطأ!</strong>..لم تتم الاضافه.. <?php
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

<div class="box-body">
    
    <div class="col-md-12" style="direction: rtl">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title" style="text-align: right">اضف شركه</h3>
            </div>
            <div class="box-body">
                <form action="?rt=Company/add" method="post"  enctype="multipart/form-data" id="myForm"  >

                    <div class="form-group">
                        <label>الاســم:</label>

                        <div class="input-group">
                            <div class="input-group-addon" >
                                <i class="fa fa-user"></i>
                            </div>
                            <input type="text" class="form-control" id="name" name="company_name" placeholder="اسم الشركه...">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <label>اللينك:</label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <input type="url" class="form-control" id="url" name="company_url" placeholder="لينك الشركه...">
                        </div>
                        <!-- /.input group -->
                    </div>

                    <div class="form-group">
                        <label>الموبايل:</label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <input type="tel" class="form-control" id="phone" name="company_phone" placeholder="الموبايل...">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <label>العنوان:</label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-home"></i>
                            </div>
                            <input type="text" class="form-control" id="address" name="company_address" placeholder="العنوان...">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <label>الصوره:</label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-image"></i>
                            </div>
                            <input type="file" class="form-control" id="file" name="file">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                    <!-- /.form group -->
                    <div class="form-group">
                        <center>
                            <div class="col-sm-offset-2 col-sm-10">
                                <input type="button" onclick="aa();" value="أضف " class="btn btn-danger"/>
                            </div>
                        </center>
                    </div>
                </form>

                <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
                <script src="//code.jquery.com/jquery-1.9.1.js"></script>

                <script type="text/javascript">

                                    function aa() {
                                        var name = $('#name').val();
                                        var url = $('#url').val();
                                        var address = $('#address').val();
                                        var phone = $('#phone').val();
                                        if (name == '' && url == '' && address == "" && phone == '') {
                                            alert("تاكد ان كل البيانات غير فارغه");
                                        } else if (name == '' || url == '' || address == "" || phone == '') {
                                            alert("تاكد البيانات غير فارغه");
                                        } else {
                                            $("#myForm").submit();
                                        }
                                    }


                </script>

            </div>
            <!-- /.box-body -->
        </div>
        <div style = "margin-top: 50%" > < /div>
        </div>
    </div>
    <!-- /.box-body -->

</div>


