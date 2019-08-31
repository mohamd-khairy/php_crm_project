<!-- Content Header (Page header) -->
<?php
$data = CompanyModel::getAll($offset);
?>

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
<section class="content-header">
    <h1>
        الشركات
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> الصفحه الرئيسيه</a></li>
        <li class="active">كل الشركات</li>

    </ol>
</section>

<div class="box-body">


    <!-- TABLE: LATEST ORDERS -->
    <div style="margin-top: 2%" class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">الشركات</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>

        <!-- /.box-header -->

        <div class="table-responsive">
            <table class="table no-margin">
                <thead>
                    <tr>
                        <?php if ($_SESSION['role'] != 'user') { ?>
                            <th>احذف</th>
                        <?php } ?>
                        <th> تاريخ البدايه </th>
                        <th>التليفون</th>
                        <th>عدد الموظفين</th>
                        <th>عدد العملاء</th>
                        <th>العنوان</th>
                        <th>الاسم</th>
                        <th>الصوره</th>
                        <th> الرقم</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($data as $company) {
                        if ($company['acc_id'] == $_SESSION['acc_id']) {
                            ?>

                            <tr>

                                <?php if ($_SESSION['role'] != 'user') { ?>
                                    <td>
                                        <div class="btn-group">
                                            <a href="index.php?rt=Company/delete&company_id=<?= $company['company_id'] ?>" type="button"  class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></a>
                                        </div>
                                    </td>
                                <?php } ?>
                                <td>
                                    <div class="sparkbar" data-color="#00a65a" data-height="20"><?= $company['company_date'] ?></div>
                                </td>
                                <td><a href="#"><?= $company['company_phone'] ?></a></td>
                                <?php $datacontact = UserModel::get_num_user_in_company($company['company_id'], $_SESSION['acc_id']); ?>
                                <td><span class="label label-danger"><?= count($datacontact) ?></span></td>
                                <?php $datacontact = ContactModel::get_num_contact_in_company($company['company_id'], $_SESSION['acc_id']); ?>
                                <td><span class="label label-success"><?= count($datacontact) ?></span></td>
                                <td><?= $company['company_address'] ?></td>
                                <td><a href="?rt=Company/profile&company_id=<?= $company['company_id'] ?>"><?= $company['company_name'] ?></a></td>
                                <td> <img style="width: 50px;height: 50px;" src="<?= HostName . DS . 'img' . DS . $company['company_image'] ?>" /></td>
                                <td><?= $i++ ?></td>
                            </tr>

                        <?php }
                    } ?>
                </tbody>
            </table>
        </div>


        <!-- /.table-responsive -->
        <div class="box-footer clearfix">

            <div class="pull-right">
                <div class="btn-group">

                    <div class="box-tools pull-right">
                        <ul class="pagination pagination-sm inline">
                            <li><a href="#">&laquo;</a></li>
                            <?php
                            for ($i = 1; $i <= $count; $i++) {
                                $current = ($i - 1) * PER_PAGE_COUNT;
                                ?>
                                <li><a href="index.php?rt=Company/show&pg=<?= $current ?>"><?= $i ?></a></li>
<?php } ?>

                            <li><a href="#">&raquo;</a></li>
                        </ul>
                    </div>  </div>
                <!-- /.btn-group -->
            </div>

            <a href="?rt=Company/add" class="btn btn-sm btn-info btn-flat pull-left">اضافه شركه جديده</a>
        </div>


    </div>
    <!-- /.box-body -->

    <!-- /.box-footer -->
    <div style="margin-top: 50%"></div>
</div>

</div>

<!-- /.box -->
