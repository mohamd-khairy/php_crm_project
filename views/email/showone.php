<!-- Content Header (Page header) -->
<?php
$data = EmailModel::getAllDatabyid(intval($_GET['id']));
//print_r($data);
?>
<!-- Main content -->
<section class="content-header">
    <h1>
        الايميل
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> الصفحه الرئيسيه</a></li>
        <li class="active">الايميلات</li>
        <li class="active">ايميل</li>
    </ol>
</section>

<!-- Main content -->
<section class="content" style="direction: rtl">
    <div class="row">

        <!-- /.col -->
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"> قراءه الايميل</h3>

                </div>
                <!-- /.box-header -->
                <?php if (!empty($data)) { ?>

                    <div class="box-body no-padding">
                        <div class="mailbox-read-info">
                            <h3>الي:</h3> <h5><?= $data[0]['email_email'] ?>
                                <span class="mailbox-read-time pull-left"><?= date('A h:i  D-m-Y',$data[0]['email_date']) ?></span></h5>
                        </div>

                        <!-- /.mailbox-controls -->
                        <div class="mailbox-read-message">
                            <h3>محتوي الايميل:</h3>

                            <p><?= $data[0]['email_content'] ?></p>
                        </div>
                        <!-- /.mailbox-read-message -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <h3>المرفق:</h3>
                        <ul class="mailbox-attachments clearfix pull-right" >
                            <li>
                                <div class="mailbox-attachment-info">
                                    <?php
                                    $str = strpos($data[0]['email_attach'], '.');

                                    if (!empty($str)) {
                                        $type = explode(".", $data[0]['email_attach'])[1];
                                        if ($type == 'jpg' || $type == 'png') {
                                            ?>
                                            <span class="mailbox-attachment-icon"><img  src="<?= HostName . DS . 'attachment' . DS . $data[0]['email_attach'] ?>"width="150" height="150" /></span>
                                            <a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i> الصوره:</a>

                                        <?php } else { ?>
                                            <span class="mailbox-attachment-icon"> <i class="fa fa-file-pdf-o"></i></span>
                                            <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i><?= $data[0]['email_attach'] ?></a>

                                        <?php }
                                    } ?>

                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- /.box-footer -->
                  
                    <!-- /.box-footer -->
<?php } ?>
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->
        <div style="margin-top: 50%"></div>
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->