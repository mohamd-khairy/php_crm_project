<!-- Content Header (Page header) -->
<div class="box-body">
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
        <div style="margin-top: 2%"></div>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript">
            window.onload = function () {
                $("#messages").animate({scrollTop: $(document).height() * 2000}, "slow");
                return false;
            };
            var arr = new Array();
            window.setInterval('refresh()', 1000);
            function refresh() {
                document.getElementById("date").innerHTML = new Date();
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.open("GET", "?rt=Post/show", false);
                xmlhttp.send(null);
                document.getElementById("d1").innerHTML = xmlhttp.responseText;
                 // beep();
                xmlhttp.open("GET", "?rt=User/showalluser", false);
                xmlhttp.send(null);
                document.getElementById("d2").innerHTML = xmlhttp.responseText;
                document.getElementById("d4").innerHTML = xmlhttp.responseText;
                return false;
            }

            function searchKeyPress(e) {
                // look for window.event in case event isn't passed in
                e = e || window.event;
                if (e.keyCode == 13)
                {
                    var post = document.getElementById("t1").value;
                    if (post == '') {
                        alert('faild -_- put the post');
                        return false;
                    }
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.open("GET", "?rt=Post/addajax&post=" + post, false);
                    xmlhttp.send(null);
                    $("#messages").animate({scrollTop: $(document).height() * 2000}, "slow");
                    var form = document.getElementById("myForm");
                    form.reset();
                    return false;
                }
                return true;
            }
            var chat_id = 0;
            var toggle = function (id) {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.open("GET", "?rt=Post/header&speak2_id=" + id, false);
                xmlhttp.send(null);
                document.getElementById("id").innerHTML = xmlhttp.responseText;
                xmlhttp.open("GET", "?rt=Post/chat&speak2_id=" + id, false);
                xmlhttp.send(null);
                chat_id = xmlhttp.responseText;
                $("#chat").show();
                window.setInterval(function () {
                    xmlhttp.open("GET", "?rt=Post/message&chat_id=" + chat_id, false);
                    xmlhttp.send(null);
                    document.getElementById("messages_green").innerHTML = xmlhttp.responseText;
                }, 1000);
            }
            function myFunction() {
                $("#messages_green").animate({scrollTop: $(document).height() * 4000}, "slow");
                return false;
            }
            function msgKeyPress(e) {
                // look for window.event in case event isn't passed in
                e = e || window.event;
                if (e.keyCode == 13)
                {
                    var msg_content = document.getElementById("msg").value;
                    if (msg_content == '' && chat_id == 0) {
                        alert('faild -_- put the msg');
                        return false;
                    }
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.open("GET", "?rt=Post/addmsg&msg_content=" + msg_content + "&chat_id=" + chat_id, false);
                    xmlhttp.send(null);
                    $("#messages_green").animate({scrollTop: $(document).height() * 4000}, "slow");
                    var form = document.getElementById("form");
                    form.reset();
                    return false;
                }
                return true;
            }
       
        </script>
    
        <div class="row" id="chat" style="display:none;" onclick="myFunction();">
            <div class="col-md-12" >
                <!-- DIRECT CHAT SUCCESS -->
                <div class="box box-success direct-chat direct-chat-success">
                    <div class="box-header with-border">
                        <div id='id'></div>
                        <center> <h3 class="box-title">
                                Direct Chat</center>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">
                                <i class="fa fa-comments"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id="messages_green" class="direct-chat-messages" >
                            <!-- Message. Default to the left -->
                        </div>
                        <div class="direct-chat-contacts">
                            <ul class="contacts-list" id="d4">
                                <!-- End Contact Item -->
                            </ul>
                            <!-- /.contatcts-list -->
                        </div>
                        <!-- /.direct-chat-pane -->
                    </div>

                    <div class="box-footer">
                        <form action="#" method="get" id="form">
                            <?php
                            if (isset($_SESSION['user_id'])) {
                                $user = UserModel::getAllDatabyid($_SESSION['user_id']);
                                ?>
                                <img class="img-responsive img-circle img-sm" src="<?= HostName . DS . 'img' . DS . $user[0]['user_image'] ?>" alt="Alt Text">
                                <?php
                            } else {
                                $manager = AccountModel::getAllDatabyid($_SESSION['acc_id']);
                                ?>
                                <img class="img-responsive img-circle img-sm" src="<?= HostName . DS . 'img' . DS . $manager[0]['acc_image'] ?>" alt="Alt Text">
                            <?php } ?>

                            <div class="img-push">
                                <input type="text" id="msg" onkeypress="return msgKeyPress(event);"  class="form-control input-sm" placeholder="Talk To Other People ...">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="all_chat">
            <div class="col-md-12">
                <!-- DIRECT CHAT PRIMARY -->
                <div class="box box-primary direct-chat direct-chat-primary">
                    <div class="box-header with-border">
                        <?php
                        if (isset($_SESSION['user_id'])) {
                            $user = UserModel::getAllDatabyid($_SESSION['user_id']);
                            ?>

                            <div class="user-block">
                                <img class="img-circle" src="<?= HostName . DS . 'img' . DS . $user[0]['user_image'] ?>" alt="User Image">
                                <span class="username"><a href="#"><?= $user[0]['user_name'] ?></a></span>
                                <span class="description" id="date"></span>
                            </div>

                            <?php
                        } else {
                            $manager = AccountModel::getAllDatabyid($_SESSION['acc_id']);
                            ?>
                            <div class="user-block">
                                <img class="img-circle" src="<?= HostName . DS . 'img' . DS . $manager[0]['acc_image'] ?>" alt="User Image">
                                <span class="username"><a href="#"> <?= $manager[0]['acc_name'] ?>
                                    </a></span>
                                <span class="description" id="date"></span>
                            </div>
                        <?php }
                        ?>

                        <div class="box-tools pull-right">

                            <button type="button"     class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">
                                <i class="fa fa-comments"></i></button>
                            <button type="button" id="btn" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- Conversations are loaded here -->
                        <div id="messages"  class="direct-chat-messages">
                            <!-- Message. Default to the left -->
                            <div id="d1"></div>
                        </div>
                        <!-- Contacts are loaded here -->
                        <div class="direct-chat-contacts">
                            <ul class="contacts-list" id="d2" >
                            </ul>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <form action="#" method="get" id="myForm">
                            <?php
                            if (isset($_SESSION['user_id'])) {
                                $user = UserModel::getAllDatabyid($_SESSION['user_id']);
                                ?>
                                <img class="img-responsive img-circle img-sm" src="<?= HostName . DS . 'img' . DS . $user[0]['user_image'] ?>" alt="Alt Text">
                                <?php
                            } else {
                                $manager = AccountModel::getAllDatabyid($_SESSION['acc_id']);
                                ?>
                                <img class="img-responsive img-circle img-sm" src="<?= HostName . DS . 'img' . DS . $manager[0]['acc_image'] ?>" alt="Alt Text">
                            <?php } ?>

                            <div class="img-push">
                                <input type="text" id="t1" onkeypress="return searchKeyPress(event);"  class="form-control input-sm" placeholder="Talk To Other People ...">
                            </div>
                        </form>
                    </div>
                    <!-- /.box-footer-->
                </div>
                <!--/.direct-chat -->
            </div>
        </div>



    </section>
    <!-- /.content -->

    <div style="margin-top: 40%"></div>

</div>