<div class="box-body">
    <section class="content-header">
        <h1>
            التقارير
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> الصفحه الرئيسيه</a></li>
            <li class="active">التقارير</li>

        </ol>
    </section>
    <script type="text/javascript">
          function PrintDiv( id_div) {
            var id=id_div;
            var type = document.getElementById(id);
            var popupWin = window.open('', '_blank', 'width=300,height=300');
            popupWin.document.open();
            popupWin.document.write('<html><body onload="window.print()">' + type.innerHTML + '</html>');
            popupWin.document.close();
        }
       
      
    </script>
    <div class="col-md-12" style="margin-top: 2%">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>

                <div class="col-md-12">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active" ><a href="#user" data-toggle="tab"><i class="fa fa-user"></i> الموظفين
                                    <span class="label label-info pull-right"></span>
                                </a></li>
                        </ul>
                        <div class="tab-content">
                            <div class=" active tab-pane" id="user">
                                <!-- The timeline -->
                                <?php
                                $datauser = UserModel::getAllData_by_acc_id($_SESSION['acc_id']);
                                ?>
                                <ul class="nav nav-pills nav-stacked " style="direction: rtl; ">
                                    <form method="post"  >
                                        <div class="col-md-2">
                                            <button  class="btn btn-default " name="search">
                                                <span >ابحث</span></button>
                                        </div>
                                        <div class="col-md-9">
                                            <select class="form-control" name="user_id"> 
                                                <?php
                                                if(!empty($datauser)){
                                                foreach ($datauser as $c) {
                                                    if (isset($_POST['user_id']) && ($_POST['user_id'] == $c['user_id'])) {
                                                        ?>
                                                        <option selected value="<?= $c['user_id'] ?>"><?= $c['user_name'] ?></option>
                                                    <?php } else { ?>
                                                        <option  value="<?= $c['user_id'] ?>"><?= $c['user_name'] ?></option>

                                                        <?php
                                                    }
                                                }}else{
                                                ?>
                                                <option value="-1">لا يوجد</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-1" >
                                            <label > الموظفين:</label>
                                        </div>
                                    </form> 


                                    <?php
                                    if (isset($_POST['search'])) {
                                        $data = UserModel::getAllDatabyid($_POST['user_id']);
                                        $datacall = CallModel::getAllDatacallby_user_id($_POST['user_id']);
                                        $tasks = TaskModel::getAllDataby_user_id($_POST['user_id']);
                                        $deals = DealModel::getAllDataby_user_id($_POST['user_id']);
                                        $emails = EmailModel::getAllDataby_user_id($_POST['user_id']);
                                        $acts = ActivityModel::get_act_by_user_id_desc($_POST['user_id'])
                                        ?>
                                        <div style="margin-left: 10%; margin-top: 5%">
                                            <div class="col-md-10">
                                                <div class="nav-tabs-custom">
                                                    <ul class="nav nav-tabs">
                                                        <li class="active"><a href="#aa" data-toggle="tab"><i class="fa fa-dashboard"></i> إحصائيات
                                                                <span class="label label-info pull-right"></span>
                                                            </a></li>
                                                        <li ><a href="#call" data-toggle="tab"><i class="fa fa-phone"></i> المكالمات
                                                                <span class="label label-info pull-right"></span>
                                                            </a></li>
                                                        <li ><a href="#task" data-toggle="tab"><i class="fa fa-tasks"></i> المهمات
                                                                <span class="label label-info pull-right"></span>
                                                            </a></li>
                                                        <li ><a href="#deal" data-toggle="tab"><i class="fa fa-money"></i> الصفقات
                                                                <span class="label label-info pull-right"></span>
                                                            </a></li>
                                                        <li ><a href="#email" data-toggle="tab"><i class="fa fa-inbox"></i> الايميلات
                                                                <span class="label label-info pull-right"></span>
                                                            </a></li>
                                                        <li ><a href="#act" data-toggle="tab"><i class="fa fa-file-text"></i> النشاطات
                                                                <span class="label label-info pull-right"></span>
                                                            </a></li>


                                                    </ul>
                                                    <div class="tab-content">
                                                        <div class="active tab-pane" id="aa">

                                                            <ul class="nav nav-pills nav-stacked">
                                                                <div class="box-footer no-padding">
                                                                    <ul class="nav nav-stacked">
                                                                        <li><a >المكالمات <span class="pull-left badge bg-green"><?= count($datacall) ?></span></a></li>
                                                                        <li><a >المهمات <span class="pull-left badge bg-gray"><?= count($tasks) ?></span></a></li>
                                                                        <li><a > الصفقات<span class="pull-left badge bg-orange"><?= count($deals) ?> </span></a></li>
                                                                        <li><a >الايميلات <span class="pull-left badge bg-aqua"><?= count($emails) ?></span></a></li>
                                                                        <li><a > النشاطات<span class="pull-left badge bg-blue"><?= count($acts) ?> </span></a></li>
                                                                        <?php if (!empty($datacall)) { ?>
                                                                            <li><a onclick="PrintDiv('divToPrint');">لطباعه  المكالمات <span class="pull-left btn btn-default bg-green">طباعه المكالمات</span></a></li>

                                                                        <?php } if (!empty($tasks)) {
                                                                            ?>
                                                                            <li><a onclick="PrintDiv('divToPrinttask');">لطباعه  المهمات  <span class="pull-left btn btn-default bg-gray">طباعه المهمات</span></a></li>
                                                                            <?php
                                                                        }
                                                                        if (!empty($deals)) {
                                                                            ?>
                                                                            <li><a onclick="PrintDiv('divToPrintdeal');" >لطباعه  الصفقات <span class="pull-left btn btn-default bg-orange">طباعه الصفقات</span></a></li>
                                                                            <?php
                                                                        }if (!empty($emails)) {
                                                                            ?>
                                                                            <li><a onclick="PrintDiv('divToPrintemail');" >لطباعه  الايميلات <span class="pull-left btn btn-default bg-aqua">طباعه الايميلات</span></a></li>
                                                                            <?php
                                                                        }
                                                                        if (!empty($acts)) {
                                                                            ?>
                                                                            <li><a onclick="PrintDiv('divToPrintact');" >لطباعه  النشاطات <span class="pull-left btn btn-default bg-blue">طباعه  النشاطات</span></a></li>
                                                                            <?php
                                                                        }
                                                                        $arr = $datacall;
                                                                        $html = "<div style='background:red;color:black;'>"
                                                                                . "<table border='1'>"
                                                                                . "<tr>"
                                                                                . "<th>#</th>"
                                                                                . "<th>الموظف</th>"
                                                                                . "<th>تفاصيل المكالمه</th>"
                                                                                . "<th>التليفون</th>"
                                                                                . "<th>تاريخ المكالمه</th>"
                                                                                . "</tr>";
                                                                        $i = 0;
                                                                        foreach ($arr as $value) {
                                                                            $html .="<tr>"
                                                                                    . "<td>" . ++$i . "</td>"
                                                                                    . "<td>" . $data[0]['user_name'] . "</td>"
                                                                                    . "<td>" . $value['call_title'] . "</td>"
                                                                                    . "<td>" . $value['call_number'] . "</td>"
                                                                                    . "<td>" . $value['call_date'] . "</td>"
                                                                                    . "</tr>";
                                                                        }
                                                                        $html .= "</table></div>";
                                                                        ?>
                                                                        <?php
                                                                        //print contact
                                                                        $arr_task = $tasks;
                                                                        $htmltask = "<div style='background:red;color:black;'>"
                                                                                . "<table border='1'>"
                                                                                . "<tr>"
                                                                                . "<th>#</th>"
                                                                                . "<th>الموظف</th>"
                                                                                . "<th>المهمه</th>"
                                                                                . "<th>تاريخ البدايه</th>"
                                                                                . "<th>تاريخ النهايه</th>"
                                                                                . "<th>الصعوبه</th>"
                                                                                . "<th> الطريقه</th>"
                                                                                . "<th> معلومات اخري</th>"
                                                                                . "</tr>";
                                                                        $i = 0;
                                                                        foreach ($arr_task as $value) {
                                                                            $htmltask .="<tr>"
                                                                                    . "<td>" . ++$i . "</td>"
                                                                                    . "<td>" . $data[0]['user_name'] . "</td>"
                                                                                    . "<td>" . $value['task_name'] . "</td>"
                                                                                    . "<td>" . $value['task_start_date'] . "</td>"
                                                                                    . "<td>" . $value['task_end_date'] . "</td>"
                                                                                    . "<td>" . $value['task_periority'] . "</td>"
                                                                                    . "<td>" . $value['task_method'] . "</td>"
                                                                                    . "<td>" . $value['other'] . "</td>"
                                                                                    . "</tr>";
                                                                        }
                                                                        $htmltask .= "</table></div>";
                                                                        ?>
                                                                        <?php
                                                                        //print deal
                                                                        $arr_deal = $deals;
                                                                        //print_r($arr_deal);
                                                                        $htmldeal = "<div style='background:red;color:black;'>"
                                                                                . "<table border='1'>"
                                                                                . "<tr>"
                                                                                . "<th>#</th>"
                                                                                . "<th>الموظف</th>"
                                                                                . "<th>الصفقه</th>"
                                                                                . "<th>القيمه</th>"
                                                                                . "<th>تاريخ بدايه الصفقه</th>"
                                                                                . "<th>تاريخ النهايه</th>"
                                                                                . "<th> معلومات اخري</th>"
                                                                                . "</tr>";
                                                                        $i = 0;
                                                                        foreach ($arr_deal as $value) {
                                                                            $htmldeal .="<tr>"
                                                                                    . "<td>" . ++$i . "</td>"
                                                                                    . "<td>" . $data[0]['user_name'] . "</td>"
                                                                                    . "<td>" . $value['deal_name'] . "</td>"
                                                                                    . "<td>" . $value['deal_value'] . "</td>"
                                                                                    . "<td>" . $value['deal_start_date'] . "</td>"
                                                                                    . "<td>" . $value['deal_end_date'] . "</td>"
                                                                                    . "<td>" . $value['other'] . "</td>"
                                                                                    . "</tr>";
                                                                        }
                                                                        $htmldeal .= "</table></div>";
                                                                        ?>    
                                                                        <?php
                                                                        //print deal
                                                                        $arr_email = $emails;
                                                                        //print_r($arr_deal);
                                                                        $htmlemail = "<div style='background:red;color:black;'>"
                                                                                . "<table border='1'>"
                                                                                . "<tr>"
                                                                                . "<th>#</th>"
                                                                                . "<th>الموظف</th>"
                                                                                . "<th>محتوي الايميل</th>"
                                                                                . "<th>التاريخ</th>"
                                                                                . "<th>الايميل</th>"
                                                                                . "</tr>";
                                                                        $i = 0;
                                                                        foreach ($arr_email as $value) {
                                                                            $htmlemail .="<tr>"
                                                                                    . "<td>" . ++$i . "</td>"
                                                                                    . "<td>" . $data[0]['user_name'] . "</td>"
                                                                                    . "<td>" . $value['email_content'] . "</td>"
                                                                                    . "<td>" . $value['email_date'] . "</td>"
                                                                                    . "<td>" . $value['email_email'] . "</td>"
                                                                                    . "</tr>";
                                                                        }
                                                                        $htmlemail .= "</table></div>";
                                                                        ?>    

                                                                        <?php
                                                                        //print deal
                                                                        $arr_act = $acts;
                                                                        //print_r($arr_deal);
                                                                        $htmlact = "<div style='background:red;color:black;'>"
                                                                                . "<table border='1'>"
                                                                                . "<tr>"
                                                                                . "<th>#</th>"
                                                                                . "<th>الموظف</th>"
                                                                                . "<th> النشاط</th>"
                                                                                . "<th>التاريخ</th>"
                                                                                . "<th>النوع</th>"
                                                                                . "</tr>";
                                                                        $i = 0;
                                                                        foreach ($arr_act as $value) {
                                                                            $htmlact .="<tr>"
                                                                                    . "<td>" . ++$i . "</td>"
                                                                                    . "<td>" . $data[0]['user_name'] . "</td>"
                                                                                    . "<td>" . $value['act_details'] . "</td>"
                                                                                    . "<td>" . $value['act_datetime'] . "</td>"
                                                                                    . "<td>" . $value['type'] . "</td>"
                                                                                    . "</tr>";
                                                                        }
                                                                        $htmlact .= "</table></div>";
                                                                        ?> 
                                                                    </ul>
                                                                </div>
                                                            </ul>

                                                        </div>
                                                        <div class="tab-pane" id="call">
                                                            <ul class="nav nav-pills nav-stacked">
                                                                <?php
                                                                $i = 1;
                                                                if (!empty($datacall)) {
                                                                    foreach ($datacall as $data) {
                                                                        ?>
                                                                        <div>
                                                                            <div class="box box-widget widget-user-2">
                                                                                <div class="widget-user-header bg-yellow">
                                                                                    <div class="widget-user-image">
                                                                                        <img class="img-circle" src="<?= HostName . DS . 'img' . DS . $data['user_image'] ?>" alt="User Avatar">
                                                                                        <center><h3 class="widget-user-username">  <?= $data['call_title'] ?></h3></center>
                                                                                        <h3 class="widget-user-username">تاريخ المكالمه: <?= $data['call_date'] ?></h3> 
                                                                                        <h5 class="widget-user-desc">الموظف:<?= $data['user_name'] ?> </h5>                                                                   
                                                                                        <h5 class="widget-user-desc">الرقم:<?= $data['user_phone'] ?> </h5>                                                                   

                                                                                    </div>
                                                                                    <!-- /.widget-user-image -->
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>

                                                            </ul>
                                                        </div>
                                                        <div class=" tab-pane" id="task">

                                                            <ul class="nav nav-pills nav-stacked">


                                                                <div class="row">
                                                                    <div class="col-xs-12">
                                                                        <div class="box">
                                                                            <div class="box-header">
                                                                                <h3 class="box-title">المهمات المكلف بها هذا العميل</h3>
                                                                            </div>
                                                                            <!-- /.box-header -->
                                                                            <div class="box-body table-responsive no-padding">
                                                                                <table class="table table-hover" style="direction: ltr">
                                                                                    <tr>
                                                                                        <th>الصعوبه</th>
                                                                                        <th>المهمه</th>
                                                                                        <th>تاريخ النهايه</th>
                                                                                        <th>تاريخ البدايه</th>
                                                                                        <th>الرقم</th>
                                                                                    </tr>
                                                                                    <?php
                                                                                    // print_r($tasks);
                                                                                    $i = 1;
                                                                                    if (!empty($tasks)) {
                                                                                        foreach ($tasks as $data) {
                                                                                            ?> 
                                                                                            <tr>
                                                                                                <?php if ($data['task_periority'] == 'easy') { ?>
                                                                                                    <td><span class="label label-success">سهل</span></td>
                                                                                                <?php } elseif ($data['task_periority'] == 'normal') { ?>
                                                                                                    <td><span class="label label-warning">متوسط</span></td>
                                                                                                <?php } else { ?>
                                                                                                    <td><span class="label label-danger">صعب</span></td>
                                                                                                <?php } ?>                                                                                             
                                                                                                <td><?= $data['task_name'] ?></td>
                                                                                                <td><?= $data['task_start_date'] ?></td>

                                                                                                <td><?= $data['task_end_date'] ?></td>
                                                                                                <td><?= $i++ ?></td>

                                                                                            </tr>
                                                                                            <?php
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                </table>
                                                                            </div>
                                                                            <!-- /.box-body -->
                                                                        </div>
                                                                        <!-- /.box -->
                                                                    </div>
                                                                </div>

                                                            </ul>

                                                        </div>
                                                        <div class="tab-pane" id="deal">
                                                            <ul class="nav nav-pills nav-stacked">
                                                                <?php
                                                                $i = 1;
                                                                if (!empty($deals)) {
                                                                    foreach ($deals as $data) {
                                                                        $startdate = new DateTime($data['deal_start_date']);
                                                                        $enddate = new DateTime(date(DateTime::ATOM));
                                                                        $diff = $startdate->diff($enddate);
                                                                        ?>

                                                                        <div class="col-md-12">
                                                                            <!-- Info Boxes Style 2 -->
                                                                            <div class="info-box bg-green">
                                                                                <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

                                                                                <div class="info-box-content">


                                                                                    <span class = "info-box-text">  الموظف:<?= $data['deal_user'] ?> </span>

                                                                                    <span class="info-box-number">قيمه الصفقه:<?= $data['deal_value'] ?></span>

                                                                                    <div class="progress">
                                                                                        <div class="progress-bar" style="width: 100%">  </div>
                                                                                    </div>
                                                                                    <?php if (strtotime(date('Y/m/d')) >= strtotime($data['deal_end_date'])) {
                                                                                        ?>
                                                                                        <span >الصفقه انتهت</span>   <?php } else {
                                                                                        ?>
                                                                                        <span >
                                                                                            تاريخ البدايه:   <?= $data['deal_start_date'] ?>  
                                                                                        </span> 
                                                                                        <span ><span >---</span>
                                                                                            تاريخ النهايه:   <?= $data['deal_end_date'] ?>  
                                                                                        </span>
                                                                                        <?php if (strtotime(date('Y/m/d')) >= strtotime($data['deal_start_date'])) { ?>
                                                                                            <span >---</span>
                                                                                            <span >
                                                                                                عدد الايام المتبقيه علي انتهاء الصفقه:   <?= $diff->days ?>  
                                                                                            </span>
                                                                                            <?php
                                                                                        } else {
                                                                                            $startdate = new DateTime($data['deal_start_date']);
                                                                                            $enddate = new DateTime($data['deal_end_date']);
                                                                                            $diff = $startdate->diff($enddate);
                                                                                            ?>
                                                                                            <span >---</span>
                                                                                            <span >
                                                                                                عدد    ايام الصفقه:   <?= $diff->days ?>  
                                                                                            </span>
                                                                                            <?php
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                </div>
                                                                                <!-- /.info-box-content -->
                                                                            </div>
                                                                        </div>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>

                                                            </ul>
                                                        </div>
                                                        <div class="tab-pane" id="email">
                                                            <ul class="nav nav-pills nav-stacked">
                                                                <?php
                                                                if (!empty($emails)) {
                                                                    // print_r($emails);
                                                                    foreach ($emails as $data) {
                                                                        ?>
                                                                        <a href="?rt=Email/showone&id=<?= $data['email_id'] ?>">
                                                                            <div class="row">
                                                                                <div class="col-md-12 col-sm-6 col-xs-12">
                                                                                    <div class="info-box">
                                                                                        <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>

                                                                                        <div class="info-box-content">
                                                                                            <span class="info-box-text"><?= $data['email_content'] ?></span>
                                                                                            <span class="info-box-text"><?= $data['email_email'] ?></span>

                                                                                            <span class="info-box-number"><?= $data['email_date'] ?></span>
                                                                                        </div>
                                                                                        <!-- /.info-box-content -->
                                                                                    </div>
                                                                                    <!-- /.info-box -->
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>

                                                            </ul>
                                                        </div>
                                                        <div class="tab-pane" id="act">
                                                            <ul class="nav nav-pills nav-stacked">

                                                                <div class="row">

                                                                    <div class="col-md-12">
                                                                        <!-- DIRECT CHAT DANGER -->
                                                                        <div class="box box-danger direct-chat direct-chat-danger">
                                                                            <div class="box-header with-border">
                                                                                <h3 class="box-title pull-left"> كل النشاطات</h3>

                                                                                <div class="box-tools pull-right">
                                                                                    <span data-toggle="tooltip" title="نشاطات   <?= count($acts) ?>" class="badge bg-red"><?= count($acts) ?></span>
                                                                                </div>


                                                                            </div>
                                                                            <!-- /.box-header -->
                                                                            <div class="box-body">
                                                                                <!-- Conversations are loaded here -->
                                                                                <div class="direct-chat-messages">
                                                                                    <?php
                                                                                    $i = 1;
                                                                                    if (!empty($acts)) {
                                                                                        //    print_r($acts);
                                                                                        foreach ($acts as $data) {
                                                                                            ?>

                                                                                            <!-- Message to the right -->
                                                                                            <div class="direct-chat-msg right">
                                                                                                <div class="direct-chat-info clearfix">
                                                                                                    <span class="direct-chat-name pull-right"><?= $userdata[0]['user_name'] ?></span>
                                                                                                    <span class="direct-chat-timestamp pull-left"><?= $data['act_datetime'] ?></span>
                                                                                                </div>
                                                                                                <!-- /.direct-chat-info -->
                                                                                                <img class="direct-chat-img" src="<?= HostName . DS . 'img' . DS . $data['user_image'] ?>" alt="Message User Image"><!-- /.direct-chat-img -->
                                                                                                <div class="direct-chat-text">
                                                                                                    <?= $data['act_details'] ?>
                                                                                                </div>
                                                                                                <!-- /.direct-chat-text -->
                                                                                            </div>
                                                                                            <!-- /.direct-chat-msg -->
                                                                                            <?php
                                                                                        }
                                                                                    }
                                                                                    ?>



                                                                                </div>
                                                                                <!--/.direct-chat-messages-->
                                                                            </div>

                                                                        </div>
                                                                        <!--/.direct-chat -->
                                                                    </div>
                                                                    <!-- /.col -->
                                                                </div>  
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <!-- /.tab-content -->
                                                </div>
                                                <!-- /.nav-tabs-custom -->
                                            </div>

                                        </div>   
                                    <?php }
                                    ?>


                                </ul>
                            </div>

                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>

                <div id="divToPrint" style="display:none;">
                    <div style="width:600px;height:300px;background-color:teal;">
                        <?php echo $html; ?>      
                    </div>
                </div>
                <div id="divToPrinttask" style="display:none;">
                    <div style="width:600px;height:300px;background-color:teal;">
                        <?php echo $htmltask; ?>      
                    </div>
                </div>
                <div id="divToPrintdeal" style="display:none;">
                    <div style="width:600px;height:300px;background-color:teal;">
                        <?php echo $htmldeal; ?>      
                    </div>
                </div>
                <div id="divToPrintemail" style="display:none;">
                    <div style="width:600px;height:300px;background-color:teal;">
                        <?php echo $htmlemail; ?>      
                    </div>
                </div>
                <div id="divToPrintact" style="display:none;">
                    <div style="width:600px;height:300px;background-color:teal;">
                        <?php echo $htmlact; ?>      
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div style="margin-top: 60%"></div>

</div>


<!-- /.box -->
