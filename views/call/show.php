<!-- Content Header (Page header) -->
<div class="box-body" id="d1">

</div>

<?php
if ($_SESSION['role'] != 'user') {
    $data = CallModel::getAll($offset);
} else {
    $data = array();
    $dataaa = CallModel::getAll($offset);
    foreach ($dataaa as $d) {
        if ($d['contact_id'] != '0') {
            $data[] = $d;
        }
    }
    //print_r($data);
}
?>
<section class="content-header">
    <h1>
        Calls
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> الصفحه الرئيسيه</a></li>
        <li class="active">المكالمات</li>
        <li class="active">الكل </li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">

        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">المكالمات</h3>


                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="mailbox-controls">
                        <!-- Check all button -->
                        <div class="btn-group">
                            <button   onclick="DeleteAll();"  type="button"  class="btn btn-danger btn-sm">حذف الكل</button>

                        </div>
                        <!-- /.btn-group -->

                        <!-- /.pull-right -->
                    </div>
                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped">
                            <thead>
                            <div id="mydiv"></div>
                            <tr>
                                <?php if ($_SESSION['role'] != 'user') { ?>
                                    <td class="label-primary">حذف</td>
                                <?php } ?>
                                <td class="label-primary">تاريخ المكالمه</td>
                                <td class="label-primary">تفاصيل المكالمه </td>
                                <td class="label-primary">الموبايل</td>
                                <td class="label-primary">رقم</td>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($data as $call) {
                                    if ($call['acc_id'] == $_SESSION['acc_id']) {
                                        ?>
                                        <tr>
                                            <?php if ($_SESSION['role'] != 'user') { ?>
                                                <td>
                                                    <div class="btn-group">
                                                        <button   onclick="aa(<?= $call['call_id'] ?>);"  type="button"  class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>

                                                    </div>
                                                </td>
                                            <?php } ?>

                                            <td class="mailbox-subject"><?= $call['call_date'] ?></td>
                                            <td class="mailbox-subject"><?= $call['call_title'] ?></td>

                                            <?php
                                            if ($call['contact_id'] == 0 && $call['user_id'] == 0) {
                                                ?>
                                                <td class="mailbox-name"><a href="#"><?= $call['call_number'] ?></a></td>
                                                <?php
                                            } elseif ($call['contact_id'] != 0 && $call['user_id'] == 0) {
                                                $data = ContactModel::getAllDatabyid($call['contact_id']);
                                                ?>
                                                <td class="mailbox-name"><a href="#"><?= $data[0]['contact_phone'] ?></a></td>
                                                <?php
                                            } elseif ($call['contact_id'] == 0 && $call['user_id'] != 0) {
                                                $data = UserModel::getAllDatabyid($call['user_id']);
                                                ?>
                                                <td class="mailbox-name"><a href="#"><?= $data[0]['user_phone'] ?></a></td>
                                            <?php } ?>
                                            <td><?= $i++ ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>

                        <script  type="text/javascript">
                            function DeleteAll() {

                                var xmlhttp = new XMLHttpRequest();
                                xmlhttp.open("GET", "?rt=Call/delete_all", false);
                                xmlhttp.send(null);
                                document.getElementById('d1').innerHTML = xmlhttp.responseText;
                                $("tbody").children().remove();
                            }
                            function aa(id) {
                                var xmlhttp = new XMLHttpRequest();
                                xmlhttp.open("GET", "?rt=Call/delete&call_id="
                                        + id, false);
                                xmlhttp.send(null);
                                document.getElementById('d1').innerHTML = xmlhttp.responseText;
                                var btn = event.target;
                                $(btn).closest("tr").remove();

                            }
                        </script>
                        <!-- /.table -->
                    </div>
                    <!-- /.mail-box-messages -->
                </div>





                <!-- /.box-body -->
                <div class="box-footer no-padding">
                    <div class="mailbox-controls">
                        <!-- Check all button -->
                        <a href="index.php?rt=Call/show" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></a>
                        <div class="btn-group">
                        </div>
                        <!-- /.btn-group -->

                        <div class="pull-right">

                            <div class="btn-group">

                                <div class="box-tools pull-right">
                                    <ul class="pagination pagination-sm inline">
                                        <li><a href="#">&laquo;</a></li>
                                        <?php
                                        for ($i = 1; $i <= $count; $i++) {
                                            $current = ($i - 1) * PER_PAGE_COUNT;
                                            ?>
                                            <li><a href="index.php?rt=Call/show&pg=<?= $current ?>"><?= $i ?></a></li>
                                        <?php } ?>

                                        <li><a href="#">&raquo;</a></li>
                                    </ul>
                                </div>  </div>

                        </div>
                        <!-- /.pull-right -->
                    </div>
                </div>
            </div>
            <!-- /. box -->
            <div style="margin-top: 50%"></div>
        </div>
        <!-- /.col -->

    </div>
    <!-- /.row -->
</section>
