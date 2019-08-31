<!-- Content Header (Page header) -->
<div class="box-body">
    <div id="d1"></div>
    <?php
    if (isset($_GET['r'])) {
        $msg = $_GET['r'];
        if ($msg == 1) {
            ?>
            <div class="box-body">
                <div class="alert alert-success h5" role="alert">تمت الارسال بنجاح...</div>
            </div>
        <?php } else if ($msg == -1) { ?>
            <div class="box-body">
                <div class="alert alert-danger h4" role="alert"><strong>خطأ!</strong>..لم يتم الارسال.. </div>
            </div>           
            <?php
        }
    }
    ?>
</div>
<?php
$data = ContactModel::getAll($offset);
?>
<section class="content-header">
    <h1>
        العملاء
        <small><?php
            $i = 0;
            foreach ($data as $c) {
                if ($c['acc_id'] == $_SESSION['acc_id']) {
                    if (date('Y-m-d') == $c['contact_date']) {
                        $i++;
                    }
                }
            }
            echo $i;
            ?> عميل جديد</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> الصفحه الرئيسيه</a></li>
        <li class="active">العملاء</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-2">
            <div class="box box-primary">

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">اختر</h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="index.php?rt=Email/send"><i class="fa fa-envelope-o"></i>ارسل ايميل
                                </a></li>
                            <li><a href="index.php?rt=Call/Add"><i class="fa fa-phone"></i>اضف مكالمه
                                </a></li>
                            <li><a href="?rt=Deal/add"><i class="fa fa-money"></i>اضف صفقه
                                </a></li>
                            <li><a href="?rt=Task/task"><i class="fa fa-tasks"></i>اضف مهمه
                                </a></li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.</div>-->
            </div>
        </div>
        <!-- /.col -->
        <div class="col-md-10" id="mido">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">العملاء</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="mailbox-controls">
                        <!-- Check all button -->
                        <div class="btn-group">

                            <a href="?rt=Contact/exel" class="btn btn-default btn-sm">أضف بيانات من ملف اكسل</a>
                            <a  href="?rt=Contact/exel&e" class="btn btn-default btn-sm">أخرج بيانات الي ملف اكسل</a>
                        </div>
                        <!-- /.btn-group -->
                        <button type="button" onclick="send_contact_id();" class="btn btn-danger btn-sm"> ارسل ايمبل للمحددين </button>
                    </div>
                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <td class="label-primary">تعديل</td>
                                    <td class="label-primary">تاريخ البدايه</td>
                                    <td class="label-primary">العنوان</td>
                                    <td class="label-primary">الشركه </td>
                                    <td class="label-primary"><b>الوظيفه</b></td>
                                    <td class="label-primary">الاسم</td>
                                    <?php if ($_SESSION['role'] != 'user') { ?>
                                        <td class="label-primary">احذف</td>
                                    <?php } ?>

                                    <td class="label-primary">الرقم</td>
                                    <td class="label-primary">
                                        <p><label><input type="checkbox"  id="checkAll"/>الكل</label></p>
                                    </td>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($data as $con) {
                                    if ($con['acc_id'] == $_SESSION['acc_id']) {
                                        ?>

                                        <tr>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="index.php?rt=Contact/profile&contact_id=<?= $con['contact_id'] ?>" type="button"  class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                                                </div>
                                            </td>
                                            <td class="mailbox-date"><?= $con['contact_date'] ?> </td>
                                            <td class="mailbox-subject"><?= $con['contact_address'] ?></td>
                                            <?php
                                            $info = CompanyModel::getAllDatabyid($con['company_id']);
                                            if (!empty($info)) {
                                                ?> 
                                                <td class="mailbox-subject"><?= $info[0]['company_name'] ?></td>
                                            <?php } else { ?> 
                                                <td class="mailbox-subject">no company now</td>

                                            <?php } ?>
                                            <td class="mailbox-subject"><b><?= $con['contact_job'] ?></b> </td>
                                            <td class="mailbox-name"><a href="index.php?rt=Contact/profile&contact_id=<?= $con['contact_id'] ?>"><?= $con['contact_name'] ?></a></td>
                                            <?php if ($_SESSION['role'] != 'user') { ?>
                                                <td>
                                                    <div class="btn-group">                                                     
                                                        <button type="button" onclick="aa(<?= $con['contact_id'] ?>);"   class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                                                    </div>
                                                </td>
                                            <?php } ?>
                                            <td><?= $i++ ?></td>
                                            <td><input type="checkbox" value="<?= $con['contact_id'] ?>" onclick="insert(<?= $con['contact_id'] ?>);" id="checkbox" /></td>

                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                       <script  type="text/javascript">
  $("#spinner").hide();

                            //مهم جدااااااا
                            // window.localStorage.setItem("cart", JSON.stringify(arr));
                            //var cart = JSON.parse(localStorage.getItem('cart'));
                            //alert(cart);// Get the text field that we're going to track
// localStorage.setItem('lastname',);

// alert(localStorage.getItem('lastname'));
                            var arr = new Array();
                            $("#checkAll").change(function () {
                                $("input:checkbox").prop('checked', $(this).prop("checked"));
                                if ($("#checkAll").prop('checked') != true) {
                                    arr = [];
                                    window.localStorage.setItem("contact_id", JSON.stringify(arr));
                                } else {
                                    $("input:checkbox").each(function () {
                                        var input = $(this).val(); // This is the jquery object of the input, do what you will
                                        if (input != "on") {
                                            if (include(arr, input) == true) {
                                            } else {
                                                arr[arr.length] = input;
                                            }
                                        }
                                    });
                                    window.localStorage.setItem("contact_id", JSON.stringify(arr));
                                }
                            });
                            function include(arr, obj) {
                                for (var i = 0; i < arr.length; i++) {
                                    if (arr[i] == obj)
                                        return true;
                                }
                            }
                            function insert(val) {
                                if (include(arr, val)) {
                                    arr = arr.filter(item => item != val);
                                    window.localStorage.setItem("contact_id", JSON.stringify(arr));
                                } else {
                                    arr[arr.length] = val;
                                    window.localStorage.setItem("contact_id", JSON.stringify(arr));
                                }
                            }

                            function send_contact_id() {
                                window.localStorage.setItem("contact_id", JSON.stringify(arr));
                                if (arr.length <= 0) {
                                    alert("اختار العميل المراد ارسال ايميل له !");
                                } else {
                                    mido("?rt=Email/sendajax");
                                    //  window.location.href = "?rt=Email/sendajax";
                                }
                            }

                            function aa(a) {
                                var xmlhttp = new XMLHttpRequest();
                                var id = a;
                                xmlhttp.open("GET", "?rt=Contact/delete&contact_id=" + id, false);
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
                        <a href="index.php?rt=Contact/show" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></a>

                        <div class="pull-right">
                            <div class="btn-group">

                                <div class="box-tools pull-right">
                                    <ul class="pagination pagination-sm inline">
                                        <li><a href="#">&laquo;</a></li>
                                        <?php
                                        for ($i = 1; $i <= $count; $i++) {
                                            $current = ($i - 1) * PER_PAGE_COUNT;
                                            ?>
                                                                                                                                            <!--   <li><button type="button" onclick=' mido("?rt=Contact/show&pg=<? $current ?>");' ><?$i ?></button></li>-->
                                            <li><a href="index.php?rt=Contact/show&pg=<?= $current ?>"><?= $i ?></a></li> 
                                        <?php } ?>

                                        <li><a href="#">&raquo;</a></li>
                                    </ul>
                                </div>  </div>
                            <!-- /.btn-group -->
                        </div>
                        <!-- /.pull-right -->
                    </div>
                </div>
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->
        <div style="margin-top: 60%"></div>
    </div>
    <!-- /.row -->
</section>
