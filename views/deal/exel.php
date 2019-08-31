<?php
session_start();
$acc_id=$_SESSION['acc_id'];
$sql = mysql_connect('localhost', 'root', '');
$db = mysql_select_db('crm_company_ar');
$result = mysql_query("select * from deal,contacts,users where deal.acc_id={$acc_id} and deal.contact_id=contacts.contact_id and deal.user_id=users.user_id");
$row = mysql_num_rows($result);
error_reporting(0);
//import
if (isset($_POST['btn_import'])) {
    if (!empty($_FILES['exel']['tmp_name'])) {
        $file_name = explode('.', $_FILES['exel']['name']);
        if ($file_name[1] == 'csv') {
            $sql = mysql_connect('localhost', 'root', '');
            $db = mysql_select_db('crm_company_ar');
            $file = $_FILES['exel']['tmp_name'];
            $file_open = fopen($file, 'r');
            $num = 0;
            while ($datafile = fgetcsv($file_open, 3000, ';')) {
                $num++;
                $name = $datafile[0];
                $job = $datafile[1];
                $email = $datafile[2];
                $phone = $datafile[3];
                $address = $datafile[4];
                $company = $datafile[5];
                $user = $datafile[6];
                $other = $datafile[7];
                $date = $datafile[8];

                if ($num != 1) {
                    mysql_query("INSERT INTO contacts(contact_name,contact_job,contact_email,contact_phone"
                            . ",contact_address,company_name,user_id,other,contact_date)"
                            . "values('$name','$job','$email','$phone','$address','$skill','$company','$user','$other','$date')");
                }
            }
            ?>
            <div class="alert alert-success h5" role="alert">Data Imported Successfully...</div>

        <?php } else { ?>
            <div class="alert alert-danger h5" role="alert">you must choose CSV file...</div>

            <?php
        }
    } else {
        ?>
        <div class="alert alert-danger h5" role="alert">choose A file...</div>
        <?php
    }
    //export
} elseif (isset($_GET['e'])) {

    if ($row >= 1) {

        $file = 'export/' . strtotime(now) . '.csv';
        $open_file = fopen($file, "w");
        $data = mysql_fetch_assoc($result);

        $lable = "Opportunity;Related To;Value;start Date;Close Date;Owner\n";
        $result2 = mysql_query("select * from deal,contacts,users where deal.acc_id=$acc_id and deal.contact_id=contacts.contact_id and deal.user_id=users.user_id");
        while ($data2 = mysql_fetch_assoc($result2)) {
            $datavalue .= $data2['deal_name'] . ";" . $data2['contact_name']  . ";" . $data2['deal_value']
                    . ";" . $data2['deal_start_date']. ";" . $data2['deal_end_date'] . ";" . $data2['user_name'] . "\n";
        }
        fputs($open_file, $lable . $datavalue);
        echo '<center><a  class="btn  btn-success btn-lg" href="' . $file . '">Download</a></center>';
        ?>
        <div class="box-body">
            <div style="margin-top: 50%" ></div>
        </div>
    <?php } else {
        ?>

        <div class="alert alert-danger h4" role="alert"><strong>Error!</strong>..No Data To Export..</div>

        <?php
    }
} else {
    ?>
    <div class="box-body">
        <div class="row">
            <div class="table-responsive">


                <form action="" method="post" enctype="multipart/form-data" >
                    <div class="form-group has-success" style="margin-left: 15%; margin-right: 25%">
                        <label class="control-label" for="inputSuccess"><i class="fa fa-file"></i> File:</label>
                        <input type="file" name="exel" class="form-control"  >
                        <input type="submit" name="btn_import" value="upload" class="btn  btn-success btn-lg"/>
                        <span class="help-block">Upload file ...</span>
                    </div>
                </form>           
            </div>
            <div style="margin-top: 50%" ></div>
        </div>
    </div>
<?php }
?>
