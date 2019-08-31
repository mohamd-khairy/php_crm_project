
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
        function PrintDiv(id_div) {
            var id = id_div;
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
                            <li class="active"><a href="#company" data-toggle="tab"><i class="fa fa-dollar"></i> الشركات
                                    <span class="label label-info pull-right"></span>
                                </a></li>


                        </ul>
                        <div class="tab-content">
                            <div class=" active tab-pane" id="company">
                                <!-- The timeline -->

                                <?php
                                $datacompany = CompanyModel::getAllData_by_acc_id($_SESSION['acc_id']);
                                ?>

                                <ul class="nav nav-pills nav-stacked " style="direction: rtl;margin-top: 1% ">
                                    <form method="post" action="?rt=Report/showcompany" >
                                        <div class="col-md-2">
                                            <button  class="btn btn-default " name="searchcompany">
                                                <span >ابحث</span></button>
                                        </div>
                                        <div class="col-md-9">
                                            <select class="form-control" name="company_id"> 
                                                <?php
                                                if (!empty($datacompany)) {
                                                    foreach ($datacompany as $c) {
                                                        if (isset($_POST['company_id']) && ($_POST['company_id'] == $c['company_id'])) {
                                                            ?>
                                                            <option selected value="<?= $c['company_id'] ?>"><?= $c['company_name'] ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?= $c['company_id'] ?>"><?= $c['company_name'] ?></option>
                                                            <?php
                                                        }
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="-1">لا يوجد</option>
                                                <?php } ?>
                                            </select>


                                        </div>
                                        <div class="col-md-1" >
                                            <label > الشركات:</label>
                                        </div>
                                    </form> 
                                    <?php
                                    if (isset($_POST['company_id'])) {
                                        $data_info_company = CompanyModel::getAllDatabyid($_POST['company_id']);
                                        $num_user_company = UserModel::get_num_user_in_company($_POST['company_id'], $_SESSION['acc_id']);
                                        $num_contact_company = ContactModel::get_num_contact_in_company($_POST['company_id'], $_SESSION['acc_id']);
                                        $data_all_event = EventModel::getAllData_by_company_name($data_info_company[0]['company_name']);
                                        ?>
                                        <div style="margin-left: 10%; margin-top: 5%">
                                            <div class="col-md-10">
                                                <div class="nav-tabs-custom">
                                                    <ul class="nav nav-tabs">


                                                        <li class="active"><a href="#aa" data-toggle="tab"><i class="fa fa-dashboard"></i> إحصائيات
                                                                <span class="label label-info pull-right"></span>
                                                            </a></li>
                                                        <li ><a href="#event" data-toggle="tab"><i class="fa fa-calendar"></i> الاحداث
                                                                <span class="label label-info pull-right"></span>
                                                            </a></li>



                                                    </ul>
                                                    <div class="tab-content">
                                                        <div class="active tab-pane" id="aa">

                                                            <ul class="nav nav-pills nav-stacked">
                                                                <div class="box-footer no-padding">
                                                                    <ul class="nav nav-stacked">
                                                                        <?php if (!empty($data_info_company)) { ?>
                                                                            <li><a >الشركه <span class="pull-left badge bg-red"><?= $data_info_company[0]['company_name'] ?> </span></a></li>
                                                                            <li><a  >الموظفين <span class="pull-left badge bg-blue"><?= count($num_user_company) ?></span></a></li>
                                                                            <li><a >العملاء <span class="pull-left badge bg-aqua"><?= count($num_contact_company) ?></span></a></li>
                                                                            <li><a >الاحداث <span class="pull-left badge bg-green"><?= count($data_all_event) ?></span></a></li>

                                                                            <li><a onclick="PrintDiv('divToPrint');">لطباعه بيانات الشركه <span class="pull-left btn btn-default bg-red">طباعه</span></a></li>
                                                                            <?php if (!empty($num_user_company)) { ?>

                                                                                <li><a onclick="PrintDiv('divToPrintuser');">لطباعه موظفين الشركه  <span class="pull-left btn btn-default bg-blue">طباعه الموظفين</span></a></li>
                                                                            <?php } if (!empty($num_contact_company)) { ?>
                                                                                
                                                                                <li><a onclick="PrintDiv('divToPrintcon');" >لطباعه عملاء الشركه <span class="pull-left btn btn-default bg-aqua">طباعه العملاء</span></a></li>
                                                                            <?php } if (!empty($data_all_event)) { ?>
                                                                                
                                                                                <li><a onclick="PrintDiv('divToPrintevent');" >لطباعه احداث الشركه <span class="pull-left btn btn-default bg-green">طباعه الاحداث</span></a></li>

                                                                                <?php
                                                                            }
                                                                            $arr = $data_info_company;
                                                                            $html = "<div style='background:red;color:black;'>"
                                                                                    . "<table border='1'>"
                                                                                    . "<tr>"
                                                                                    . "<th>الشركه</th>"
                                                                                    . "<th>الرابط</th>"
                                                                                    . "<th>التليفون</th>"
                                                                                    . "<th>العنوان</th>"
                                                                                    . "<th>التاريخ</th>"
                                                                                    . "<th>عدد الموظفين</th>"
                                                                                    . "<th>عدد العملاء</th>"
                                                                                    . "</tr>";

                                                                            foreach ($arr as $value) {
                                                                                // $html .= $value . '<br />';
                                                                                $html .="<tr>"
                                                                                        . "<td>" . $value['company_name'] . "</td>"
                                                                                        . "<td>" . $value['company_url'] . "</td>"
                                                                                        . "<td>" . $value['company_phone'] . "</td>"
                                                                                        . "<td>" . $value['company_address'] . "</td>"
                                                                                        . "<td>" . $value['company_date'] . "</td>"
                                                                                        . "<td>" . count($num_user_company) . "</td>"
                                                                                        . "<td>" . count($num_contact_company) . "</td>"
                                                                                        . "</tr>";
                                                                            }
                                                                            $html .= "</table></div>";
                                                                            ?>
                                                                            <?php
                                                                            //print contact
                                                                            $arr_contact = $num_contact_company;
                                                                            // print_r($arr_contact);
                                                                            $htmlcontact = "<div style='background:red;color:black;'>"
                                                                                    . "<table border='1'>"
                                                                                    . "<tr>"
                                                                                    . "<th>الشركه</th>"
                                                                                    . "<th>الاسم</th>"
                                                                                    . "<th>التليفون</th>"
                                                                                    . "<th>العنوان</th>"
                                                                                    . "<th>التاريخ</th>"
                                                                                    . "<th> الوظيفه</th>"
                                                                                    . "<th> معلومات اخري</th>"
                                                                                    . "</tr>";

                                                                            foreach ($arr_contact as $value) {
                                                                                // $html .= $value . '<br />';
                                                                                $htmlcontact .="<tr>"
                                                                                        . "<td>" . $data_info_company[0]['company_name'] . "</td>"
                                                                                        . "<td>" . $value['contact_name'] . "</td>"
                                                                                        . "<td>" . $value['contact_phone'] . "</td>"
                                                                                        . "<td>" . $value['contact_address'] . "</td>"
                                                                                        . "<td>" . $value['contact_date'] . "</td>"
                                                                                        . "<td>" . $value['contact_job'] . "</td>"
                                                                                        . "<td>" . $value['contact_other'] . "</td>"
                                                                                        . "</tr>";
                                                                            }
                                                                            $htmlcontact .= "</table></div>";
                                                                            ?>
                                                                            <?php
                                                                            //print users
                                                                            $arr_user = $num_user_company;
                                                                            //print_r($arr);
                                                                            $htmluser = "<div style='background:red;color:black;'>"
                                                                                    . "<table border='1'>"
                                                                                    . "<tr>"
                                                                                    . "<th>الشركه</th>"
                                                                                    . "<th>الاسم</th>"
                                                                                    . "<th>الايميل</th>"
                                                                                    . "<th>العنوان</th>"
                                                                                    . "<th>التاريخ</th>"
                                                                                    . "<th> الوظيفه</th>"
                                                                                    . "<th> الحاله</th>"
                                                                                    . "<th> معلومات اخري</th>"
                                                                                    . "</tr>";

                                                                            foreach ($arr_user as $value) {
                                                                                // $html .= $value . '<br />';
                                                                                $htmluser .="<tr>"
                                                                                        . "<td>" . $data_info_company[0]['company_name'] . "</td>"
                                                                                        . "<td>" . $value['user_name'] . "</td>"
                                                                                        . "<td>" . $value['user_email'] . "</td>"
                                                                                        . "<td>" . $value['user_address'] . "</td>"
                                                                                        . "<td>" . $value['user_date'] . "</td>"
                                                                                        . "<td>" . $value['user_job'] . "</td>"
                                                                                        . "<td>" . $value['role'] . "</td>"
                                                                                        . "<td>" . $value['user_other'] . "</td>"
                                                                                        . "</tr>";
                                                                            }
                                                                            $htmluser .= "</table></div>";
                                                                            ?>
                                                                            <?php
                                                                            //print users
                                                                            $arr_event = $data_all_event;
                                                                            //print_r($arr);

                                                                            $htmlevent = "<div style='background:red;color:black;'>"
                                                                                    . "<table border='1'>"
                                                                                    . "<tr>"
                                                                                    . "<th>الشركه</th>"
                                                                                    . "<th>الحدث</th>"
                                                                                    . "<th>التاريخ</th>"
                                                                                    . "</tr>";

                                                                            foreach ($arr_event as $value) {
                                                                                // $html .= $value . '<br />';
                                                                                $htmlevent .="<tr>"
                                                                                        . "<td>" . $data_info_company[0]['company_name'] . "</td>"
                                                                                        . "<td>" . $value['title'] . "</td>"
                                                                                        . "<td>" . $value['created'] . "</td>"
                                                                                        . "</tr>";
                                                                            }
                                                                            $htmlevent .= "</table></div>";
                                                                            ?>
                                                                        <?php } ?>
                                                                    </ul>
                                                                </div>
                                                            </ul>

                                                        </div>
                                                        <div class=" tab-pane" id="event">

                                                            <ul class="nav nav-stacked">
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-xs-12">
                                                                        <?php
                                                                        foreach ($data_all_event as $e) {
                                                                            ?>
                                                                            <!-- small box -->
                                                                            <div class="small-box bg-green">
                                                                                <div class="icon pull-left"  >
                                                                                    <i class="fa fa-calendar"></i>
                                                                                </div>
                                                                                <div class="inner ">

                                                                                    <h3 class="pull-left"><?= $e['title'] ?></h3><br /><br />
                                                                                    <h4 class="pull-left"><?= date('D-m-Y   h:i A', strtotime($e['created'])) ?></h4>

                                                                                    <div style="margin-top: 5%"></div>
                                                                                </div>
                                                                                <?php
                                                                                $startdate = new DateTime(date(DateTime::ATOM));
                                                                                $enddate = new DateTime($e['created']);
                                                                                $diff = $startdate->diff($enddate);
                                                                                ?>

                                                                                <a class="small-box-footer">باقي <?= $diff->days ?> ايام  </a>
                                                                            </div>
                                                                        <?php } ?>
                                                                    </div>  
                                                                </div>  
                                                            </ul>                             
                                                        </div>
                                                    </div>
                                                    <!-- /.tab-content -->
                                                </div>
                                                <!-- /.nav-tabs-custom -->
                                            </div>
                                        </div>
                                    </ul>
                                <?php } ?>
                            </div>

                            <!-- /.tab-content -->
                        </div>
                        <!-- /.nav-tabs-custom -->

                    </div>
                </div>

                <div id="divToPrint" style="display:none;">
                    <div style="width:600px;height:300px;background-color:teal;">
                        <?php echo $html; ?>      
                    </div>
                </div>
                <div id="divToPrintcon" style="display:none;">
                    <div style="width:600px;height:300px;background-color:teal;">
                        <?php echo $htmlcontact; ?>      
                    </div>
                </div>
                <div id="divToPrintuser" style="display:none;">
                    <div style="width:600px;height:300px;background-color:teal;">
                        <?php echo $htmluser; ?>      
                    </div>
                </div>
                <div id="divToPrintevent" style="display:none;">
                    <div style="width:600px;height:300px;background-color:teal;">
                        <?php echo $htmlevent; ?>      
                    </div>
                </div>

            </div>
        </div>
        <div style="margin-top: 60%"></div>
    </div>


    <!-- /.box -->
