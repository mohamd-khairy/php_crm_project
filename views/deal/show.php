<div class="box-body" id="d1">
</div>
<!-- Content Header (Page header) -->
<?php
$data = DealModel::getAll($offset);
?>

<section class="content-header">
    <h1>
        جديد 
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> الصفحه الرئيسيه</a></li>
        <li class="active">الصفقات</li>

    </ol>
</section>
<div class="box-body">
    <!-- TABLE: LATEST ORDERS -->
    <div style="margin-top: 2%" class="box box-info">
    <div class="box-header with-border">
            <h3 class="box-title">الصفقات</h3>

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
                            <?php if ($_SESSION['role'] != 'user') { ?>
                                <th>الحذف</th>
                            <?php } ?>

                            <th>معلومات اخري</th>
                            <th>تاريخ الانتهاء</th>
                            <th>تاريخ البدايه</th>
                            <th>القيمه</th>
                            <th>  الشخص</th>
                            <th> الصفقه</th>
                            <th> الرقم</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($data as $deal) {
                            if ($deal['acc_id'] == $_SESSION['acc_id']) {
                                ?>

                                <tr>
                                    <?php if ($_SESSION['role'] != 'user') { ?>
                                        <td>
                                            <div class="btn-group">
                                                <button onclick="aa(<?= $deal['deal_id'] ?>);" type="button"  class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                                            </div>
                                        </td>
                                    <?php } ?>

                                    <td><span ><?= $deal['other'] ?></span></td>
                                    <td><a href="#"><?= $deal['deal_end_date'] ?></a></td>
                                    <td><a href="#"><?= $deal['deal_start_date'] ?></a></td>

                                    <td><span class="label label-danger"><?= $deal['deal_value'] ?></span></td>

                                    <td><span ><?= $deal['deal_user'] ?></span></td>


                                    <td><a href="index.php?rt=Deal/profile&deal_id=<?= $deal['deal_id'] ?>"><?= $deal['deal_name'] ?></a></td>
                                    <td><?= $i++ ?></td>
                                </tr>

                                <?php
                            }
                        }
                        ?>

                    </tbody>
                </table>
                <script  type="text/javascript">
                    function aa(a) {
                        var xmlhttp = new XMLHttpRequest();
                        var id = a;
                        xmlhttp.open("GET", "?rt=Deal/delete&deal_id=" + id, false);
                        xmlhttp.send(null);
                        document.getElementById('d1').innerHTML = xmlhttp.responseText;
                        var btn = event.target;
                        $(btn).closest("tr").remove();

                    }
                </script>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">

            <a href="?rt=Deal/addother" class="btn btn-sm btn-info btn-flat pull-left"> صفقه جديده</a>

            <div class="pull-right">
                <div class="btn-group">

                    <div class="box-tools pull-right">
                        <ul class="pagination pagination-sm inline">
                            <li><a href="#">&laquo;</a></li>
                            <?php
                            for ($i = 1; $i <= $count; $i++) {
                                $current = ($i - 1) * PER_PAGE_COUNT;
                                ?>
                                <li><a href="index.php?rt=Deal/show&pg=<?= $current ?>"><?= $i ?></a></li>
                            <?php } ?>

                            <li><a href="#">&raquo;</a></li>
                        </ul>
                    </div>  </div>
                <!-- /.btn-group -->
            </div>
        </div>
        <!-- /.box-footer -->

    </div>
    <div style="margin-top: 60%"></div>

</div>
<!-- /.box -->
