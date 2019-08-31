<div class="box box-warning">
    <div class="box-header with-border has-error">
        <h3 class="box-title" style="margin-right: 70%">مهمه جديده</h3>
    </div>
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
            <?php
        }
    }
    ?>
    <div class = "row" style="direction: rtl">
        <?php
        $dataa = ContactModel::getAllData_by_acc_id($_SESSION['acc_id']);
        ?>      
        <form action="?rt=task/add" method="post" enctype="multipart/form-data">
            <!-- contact array-->
            <div class="form-group has-success" style="margin-left: 15%; margin-right: 25%">
                <label class="control-label" for="inputError"><i class="fa fa-user"></i> العميل:</label>
                <select name="contact_id" class="form-control">
                    <?php
                    if (!empty($dataa)) {
                        foreach ($dataa as $data) {
                            ?>
                            <option value="<?= $data['contact_id'] ?>"><?= $data['contact_name'] ?></option>
                            <?php
                        }
                    } else {
                        ?>
                        <option value="0">لايوجد عملاء..</option>
                    <?php } ?>
                </select>
                <span class="help-block">اختار اسم العميل ...</span>
            </div>

            <div class="form-group has-warning" style="margin-left: 15%; margin-right: 25%">
                <label class="control-label" for="inputSuccess"><i class="fa fa-tasks"></i> المهمه:</label>
                <input type="text" name="task_name" class="form-control" id="inputSuccess" placeholder="ادخل المطلوب ...">
                <span class="help-block">ادخل المطلوب فالمهمه  ...</span>
            </div>

            <div class="form-group has-feedback" style="margin-left: 15%; margin-right: 25%">
                <label class="control-label" for="inputEmail"><i class="fa fa-times"></i> تاريخ البدايه:</label>
                <input type="date"  name="task_start_date" class="form-control" id="inputEmail">
                <span class="help-block">ادخل تاريخ البدايه ... </span>
            </div>
            <div class="form-group has-feedback" style="margin-left: 15%; margin-right: 25%">
                <label class="control-label" for="inputSuccess"><i class="fa fa-times"></i> تاريخ النهايه :</label>
                <input type="date" name="task_end_date" class="form-control" id="inputSuccess" >
                <span class="help-block">ادخل تاريخ الانتهاء ...</span>
            </div>

            <div class="form-group has-error" style="margin-left: 15%; margin-right: 25%">
                <label class="control-label" for="inputError"><i class="fa fa-rss"></i> مستوي الصعوبه:</label>
                <select name="task_periority" class="form-control">
                    <option value="hard">صعب</option>
                    <option value="normal">متوسط</option>
                    <option value="easy">سهل</option>
                </select>

                <span class="help-block">اختار مستوي الصعوبه ...</span>
            </div>

            <?php
            $deal = DealModel::getAllData_by_acc_id($_SESSION['acc_id']);
            ?>
            <div class="form-group has-success" style="margin-left: 15%; margin-right: 25%">
                <label class="control-label" for="inputSuccess"><i class="fa fa-money"></i> الصفقه:</label>
                <select name="deal_id" class="form-control" >
                    <?php
                    if (!empty($deal)) {
                        foreach ($deal as $d) {
                            ?>
                            <option value="<?= $d['deal_id'] ?>" ><?= $d['deal_name'] ?></option>
                        <?php } ?>
                        <option value="0" >لا يوجد صفقه</option>
                    <?php } else { ?>
                        <option value="0" >لا يوجد صفقات</option>

                    <?php } ?>
                </select>

                <span class="help-block">اختار الصفقه ...
                </span>
            </div>


            <div class="form-group has-warning" style="margin-left: 15%; margin-right: 25%">
                <label class="control-label" for="inputSuccess"><i class="fa fa-rss"></i> معلومات اخري:</label>
                <input type="text" name="other" class="form-control" id="inputSuccess" placeholder="تفاصيل اخري ...">
                <span class="help-block">ادخل معلومات اخري ...</span>
            </div>

            <div  >
                <center>
                    <input  type="hidden"  name="task_method" value="<?= $task_method ?>" style="width: 150px" class="btn  btn-success btn-lg">
                    <input  type="hidden"  name='acc_id' value="<?= $_SESSION['acc_id'] ?>" style="width: 150px" class="btn  btn-success btn-lg">
                    <input  type="submit" name="add"  value="أضف" style="width: 150px" class="btn  btn-success btn-lg">
                    <button  type="reset" style="width: 150px"class="btn  btn-success btn-lg">أمسح</button>
                </center>
            </div>

        </form>

        <div style="margin-top: 30%"></div>
    </div>

</div>



