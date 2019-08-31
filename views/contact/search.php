
<div class="box-header with-border has-error">
    <h3 class="box-title" style="margin-right: 70%">البحث</h3>
</div>
<?php
if (isset($msg)) {
    if ($msg == 1) {
        ?>
        <div class="alert alert-success h5" role="alert">Operation done Successfully...</div>
    <?php } else if ($msg == -1) { ?>
        <div class="alert alert-danger h4" role="alert"><strong>Error!</strong>..some thing wrong..</div>
        <?php
    }
}
?>

<div class="row">
    <div class="col-md-12">
        <!-- /.box-header -->
        <div class="box-body">
            <!-- PRODUCT LIST -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">العملاء</h3>

                    <div class="box-tools pull-right">

                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->




                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>تاريخ البدايه</th>
                                    <th>معلومات اخري</th>
                                    <th>الوظيفه</th>
                                    <th>العنوان</th>
                                    <th>الموبايل</th>
                                    <th>الاسم</th>
                                    <th> الصوره</th>
                                    <th>النوع</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($datasearch as $data) { ?>
                                    <tr>

                                        <td>
                                            <div class="sparkbar" data-color="#00a65a" data-height="20"><?= $data['contact_date'] ?></div>
                                        </td>         
                                        <td><?= $data['contact_other'] ?></td>
                                        <td><span class="label label-success"><?= $data['contact_job'] ?></span></td>
                                        <td><?= $data['contact_address'] ?></td>
                                        <td><a href="#"><?= $data['contact_phone'] ?></a></td>
                                        <td><a href="?rt=Contact/profile&contact_id=<?= $data['contact_id'] ?>"><?= $data['contact_name'] ?></a></td>
                                        <td><img src="<?= HostName . DS . 'img/avatar5.png' ?>" width="50" height="50" /></td>
                                        <td>عميل</td>




                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>



                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
    </div>

    <div style="margin-top: 50%"></div>
</div>
