<?php
$result2 = ContactModel::getAllData_by_acc_id($_SESSION['acc_id']);
$row = count($result2);
error_reporting(0);
if (isset($_POST['btn_import'])) {
    if (!empty($_FILES['exel']['tmp_name'])) {
        $file_name = explode('.', $_FILES['exel']['name']);
        if ($file_name[1] == 'csv') {
            $file = $_FILES['exel']['tmp_name'];
            $file_open = fopen($file, 'r');
            $num = 0;
            while ($datafile = fgetcsv($file_open, 3000, ';')) {
                $num++;
                $name = $datafile[0];
                $email = $datafile[1];
                $phone = $datafile[2];
                $address = $datafile[3];
                $company = $datafile[4];
                $job = $datafile[5];
                $other = $datafile[6];
                $date = $datafile[7];
                if (empty($date)) {
                    $date = date('Y/m/d');
                }
                $id = $_SESSION['acc_id'];
                $com = CompanyModel::get_company_Data_by_name(strtoupper($company));
                if (!empty($com)) {
                    $company_id = $com[0]['company_id'];
                }
                if ($num != 1) {
                    $con = new ContactModel();
                    $con->company_id = $company_id;
                    $con->contact_address = $address;
                    $con->contact_date = $date;
                    $con->contact_email = $email;
                    $con->acc_id = $id;
                    $con->contact_job = $job;
                    $con->contact_phone = $phone;
                    $con->contact_other = $other;
                    if ($con->insert() >= 1) {
                        $m = 1;
                    } else {
                        $m = -1;
                    }
                }
            }
            if (isset($m)) {
                if ($m != 1) {
                    ?>
                    <div class="box-body">
                        <div class="alert alert-danger h5" role="alert">البيانات  لم تضاف ...</div>

                    <?php } else {
                        ?>
                        <div class="box-body">
                            <div class="alert alert-success h5" role="alert">البيانات أخذت بنجاح...</div>
                        <?php } ?>
                        <div class="row">
                            <div class="table-responsive">
                                <form action="" method="post" enctype="multipart/form-data" >
                                    <div class="form-group has-success" style="margin-left: 15%; margin-right: 25%">
                                        <label class="control-label" for="inputSuccess"><i class="fa fa-file"></i> الملف:</label>
                                        <input type="file" name="exel" class="form-control"  >
                                        <input type="submit" name="btn_import" value="ارفع" class="btn  btn-success btn-lg"/>
                                        <span class="help-block">ارفع الملف ...</span>
                                    </div>
                                </form>           
                            </div>
                            <div style="margin-top: 50%" ></div>
                        </div>
                    </div>
                    <?php
                } else {
                    echo 'error';
                }
            } else {
                echo 'يجب اختيار ملف  csv';
            }
        } else {
            echo ' اختار ملف  !!';
        }
    } elseif (isset($_GET['e'])) {

        if ($row >= 1) {
            $name = 'contact_' . time() . '.csv';
            $file = 'export/' . $name;
            $open_file = fopen($file, "w");
            $lable = "number; name;job; email;mobile;address; company;details  ;date\n";
            $datavalue = '';
            foreach ($result2 as $data2) {
                $company = CompanyModel::getAllDatabyid($data2['company_id']);
                $datavalue .= $data2['contact_id'] . ";" . $data2['contact_name']
                        . ";" . $data2['contact_job'] . ";" . $data2['contact_email'] . ";" . $data2['contact_phone'] . ";" . $data2['contact_address']
                        . ";" . $company[0]['company_name'] . ";" . $data2['contact_other'] . ";" . $data2['contact_date'] . "\n";
            }
            fputs($open_file, $lable . $datavalue);
            echo '<center><a  class="btn  btn-success btn-lg" href="' . $file . '">Download</a></center>';
            ?>
            <div class="box-body">
                <div style="margin-top: 50%" ></div>
            </div>
        <?php } else {
            ?>
            <div class="box-body">
                <div class="alert alert-danger h4" role="alert"><strong>خطا!</strong>..لا يوجد بيانات..</div>
            </div>           
            <?php
        }
    } else {
        ?>
        <div class="box-body">
            <div class="row">
                <div class="table-responsive">


                    <form action="" method="post" enctype="multipart/form-data" >
                        <div class="form-group has-success" style="margin-left: 15%; margin-right: 25%">
                            <label class="control-label" for="inputSuccess"><i class="fa fa-file"></i> الملف:</label>
                            <input type="file" name="exel" class="form-control"  >
                            <input type="submit" name="btn_import" value="ارفع" class="btn  btn-success btn-lg"/>
                            <span class="help-block">ارفع الملف ...</span>
                        </div>
                    </form>           
                </div>
                <div style="margin-top: 50%" ></div>
            </div>
        </div>
    <?php }
    ?>
