<!-- Content Header (Page header) -->
<div class="box-body" id="d1">

</div>
<?php
if ($_SESSION['role'] != 'user') {
    $data = EmailModel::getAll($offset);
} else {
    $data = array();
    $dataaa = EmailModel::getAll($offset);
    foreach ($dataaa as $d) {
        if ($d['contact_id'] != '0') {
            $data[] = $d;
        }
    }
    //print_r($data);
}
//print_r($data);
?>
<section class="content-header">
    <h1>
        الايميلات
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> الصفحه الرئيسيه</a></li>
        <li class="active">الايميل</li>
    </ol>
</section>
<!-- Main content -->
<script  type="text/javascript">
    function aa(a) {
        var xmlhttp = new XMLHttpRequest();
        var id = a;
        xmlhttp.open("GET", "?rt=Email/delete&id=" + id, false);
        xmlhttp.send(null);
        document.getElementById('d1').innerHTML = xmlhttp.responseText;
        var btn = event.target;
        $(btn).closest("tr").remove();

    }
    function DeleteAll() {

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "?rt=Email/delete_all", false);
        xmlhttp.send(null);
        document.getElementById('d1').innerHTML = xmlhttp.responseText;
        $("tbody").children().remove();
    }
</script>
<section class="content">
    <div class="row">

        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">كل الايميلات</h3>

                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="mailbox-controls">
                        <!-- Check all button -->
                        <div class="btn-group">
                            <?php if ($_SESSION['role'] != 'user') { ?>
                                <button type="button" onclick="DeleteAll();" class="btn btn-danger btn-sm">حذف الكل</button>
                            <?php } ?>
                            <a href="?rt=Email/sendother" class="btn btn-primary btn-sm">ارسال ايميل</a>

                        </div>

                        <!-- /.pull-right -->
                    </div>
                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <?php if ($_SESSION['role'] != 'user') { ?>
                                        <td class="label-primary">احذف</td>
                                    <?php } ?>

                                    <td class="label-primary">تاريخ الارسال</td>
                                    <td class="label-primary">الايميل</td>
                                    <td class="label-primary">الاسم</td>
                                    <td class="label-primary">#</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($data as $email) {
                                    if ($email['acc_id'] == $_SESSION['acc_id']) {
                                        ?>
                                        <tr>
                                            <?php if ($_SESSION['role'] != 'user') { ?>
                                                <td>
                                                    <div class="btn-group">
                                                        <button onclick="aa(<?= $email['email_id'] ?>);" type="button"  class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                                                    </div>
                                                </td>

                                            <?php } ?> 
                                            <td class="mailbox-subject"><?= date('h:i A D-m-Y',$email['email_date']) ?></td>
                                            <td class="mailbox-subject"><?= $email['email_email'] ?></td>

                                            <?php if ($email['contact_id'] == 0 && $email['user_id'] == 0) { ?>
                                                <td class="mailbox-name"><a href="?rt=Email/showone&id=<?= $email['email_id'] ?>">private</a></td>
                                                <?php
                                            } elseif ($email['contact_id'] == 0 && $email['user_id'] != 0) {
                                                $data = UserModel::getAllDatabyid($email['user_id']);
                                                ?>
                                                <td class="mailbox-name"><a href="?rt=Email/showone&id=<?= $email['email_id'] ?>"><?= $data[0]['user_name'] ?></a></td>

                                                <?php
                                            } elseif ($email['contact_id'] != 0 && $email['user_id'] == 0) {
                                                $data = ContactModel::getAllDatabyid($email['contact_id']);
                                                ?>
                                                <td class="mailbox-name"><a href="?rt=Email/showone&id=<?= $email['email_id'] ?>"><?= $data[0]['contact_name'] ?></a></td>
                                                <?php
                                            } else {
                                                
                                            }
                                            ?>
                                            <td><?= $i++; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- /.table -->
                    </div>
                    <!-- /.mail-box-messages -->
                </div>





                <!-- /.box-body -->
                <div class="box-footer no-padding">
                    <div class="mailbox-controls">
                        <!-- Check all button -->
                        <a href="index.php?rt=Email/show" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></a>

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
                                            <li><a href="index.php?rt=Email/show&pg=<?= $current ?>"><?= $i ?></a></li>
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
        </div>
        <!-- /.col -->
        <div style="margin-top: 50%"></div>
    </div>
    <!-- /.row -->
</section>
