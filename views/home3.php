
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        احصائيات
        <small> لوحه التحكم </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> الصفحه الرئيسيه</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row">

        <div class="col-md-3 col-sm-6 col-xs-12">
            <?php $event = EventModel::getAllData_by_acc_id($_SESSION['acc_id']); ?>
            <div class="info-box">
                <a href="index.php?rt=Event/show"> <span class="info-box-icon bg-aqua"><i class="fa fa-coffee"></i></span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text">الاحداث</span>
                    <span class="info-box-number"><?= count($event) ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <?php
            if ($_SESSION['role'] != 'user') {
                $deal = CallModel::getAllData_by_acc_id($_SESSION['acc_id']);
            } else {
                $deal = CallModel::getAllData_by_contact_id_not_equal_null_fornotify($_SESSION['acc_id']);
            }
            ?>
            <div class="info-box">
                <a href="index.php?rt=Call/show">  <span class="info-box-icon bg-red"><i class="fa fa-phone"></i></span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text">المكالمات</span>
                    <span class="info-box-number"><?= count($deal) ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <?php if ($_SESSION['role'] != 'manager') { ?>
            <div class="clearfix visible-sm-block"></div>
            <?php
            if ($_SESSION['role'] != 'user') {
                $act = TaskModel::getAllData_by_acc_id($_SESSION['acc_id']);
            } else {
                $act = TaskModel::getAllData_by_contact_id_not_equal_null_fornotify($_SESSION['acc_id']);
            }
            ?>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <a href="index.php?rt=Task/task">    <span class="info-box-icon bg-green"><i class="fa fa-tasks"></i></span>
                    </a>
                    <div class="info-box-content">
                        <span class="info-box-text">المهمات</span>
                        <span class="info-box-number"><?= count($act) ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        <?php } else { ?>
            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>
            <?php $act = ActivityModel::getAllData_by_acc_id($_SESSION['acc_id']); ?>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <a href="index.php?rt=Activity/show">    <span class="info-box-icon bg-green"><i class="fa fa-info"></i></span>
                    </a>
                    <div class="info-box-content">
                        <span class="info-box-text">النشاطات</span>
                        <span class="info-box-number"><?= count($act) ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        <?php } ?>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <?php
            if ($_SESSION['role'] != 'user') {
                $email = EmailModel::getAllData_by_acc_id($_SESSION['acc_id']);
            } else {
                $email = EmailModel::getAllData_by_contact_id_not_equal_null_fornotify($_SESSION['acc_id']);
            }
            ?>
            <div class="info-box">
                <a href="index.php?rt=Email/show">   <span class="info-box-icon bg-yellow"><i class="fa fa-inbox"></i></span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text">الايميلات</span>
                    <span class="info-box-number"><?= count($email) ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- The time line -->
            <ul class="timeline">
                <li>
                    <i class="fa fa-video-camera bg-maroon"></i>

                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i><?= date("d/m/Y") ?></span>

                        <div class="timeline-body">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/r6hxqg3PgRQ" frameborder="0" allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="timeline-footer">
                            <a href="http://www.youtube.com" class="btn btn-xs bg-maroon">شاهد المزيد </a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div style="margin-top: 40%"></div>
</section>
<!-- /.content -->


