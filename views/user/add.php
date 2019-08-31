
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

<!-- /.box-header -->
<div class="box-body">

    <div class="col-md-12" style="direction: rtl">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title" style="text-align: right">اضف موظف</h3>
            </div>
            <div class="box-body ">
                <form role="form" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label>الاســم:</label>

                        <div class="input-group">
                            <div class="input-group-addon" >
                                <i class="fa fa-user"></i>
                            </div>
                            <input type="text" class="form-control" name="user_name" placeholder="اسم الموظف...">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <label>الايميل:</label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <input type="text" class="form-control" name="user_email" placeholder="الايميل...">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <label>كلمه الســر:</label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-pencil"></i>
                            </div>
                            <input type="password" class="form-control" name="user_password" placeholder="كلمه السر...">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <label>الموبايل:</label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <input type="tel" class="form-control" name="user_phone" placeholder="الموبايل...">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <label>العنوان:</label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-home"></i>
                            </div>
                            <input type="text" class="form-control" name="user_address" placeholder="العنوان...">
                        </div>
                        <!-- /.input group -->
                    </div>
                    
                    <div class="form-group">
                        <label>الشركه:</label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <select name="company_id" class="form-control">
                                <?php
                                $dataa = CompanyModel::getAllData_by_acc_id($_SESSION['acc_id']);
                                if (!empty($dataa)) {
                                    foreach ($dataa as $data) {
                                        ?>
                                        <option value="<?= $data['company_id'] ?>"><?= $data['company_name'] ?></option>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <option value="0">لايوجد</option>

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
                            <input type="text" class="form-control" name="user_job" placeholder=" الوظيفه...">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                    <!-- phone mask -->
                    <div class="form-group">
                        <label>الصـوره:</label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-image"></i>
                            </div>
                            <input type="file" class="form-control" name="user_image">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                    <div class="form-group">
                        <label>الصلاحيه:</label>
                        <div class="input-group">
                            موظف
                            <input type="radio" name="role" value="user" class="minimal-red" checked>


                            أدمن
                            <input type="radio" name="role"  value="admin" class="minimal-red">

                        </div>    
                    </div>


                    <!-- IP mask -->
                    <div class="form-group">
                        <label>معلومات اخري:</label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-book"></i>
                            </div>
                            <input type="text" class="form-control" name="user_other" placeholder="تفاصيل اخري...">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" value="أضف " class="btn btn-danger"/>
                        </div>
                    </div>

                </form>

            </div>
            <!-- /.box-body -->
        </div>

    </div>

    <div style="margin-top: 30%"></div>

</div>
<!-- /.box-body -->




