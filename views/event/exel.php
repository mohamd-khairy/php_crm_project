<?php
$sql = mysql_connect('localhost', 'root', '');
$db = mysql_select_db('crm_company');
$result = mysql_query("select * from events");
$row = mysql_num_rows($result);
error_reporting(0);
//import
if (isset($_POST['btn_import'])) {
    if (!empty($_FILES['exel']['tmp_name'])) {
        $file_name = explode('.', $_FILES['exel']['name']);
        if ($file_name[1] == 'csv') {
            $sql = mysql_connect('localhost', 'root', '');
            $db = mysql_select_db('crm_company');
            $file = $_FILES['exel']['tmp_name'];
            $file_open = fopen($file, 'r');
            $num = 0;
            while ($datafile = fgetcsv($file_open, 3000, ';')) {
                $num++;
                $fname = $datafile[0];
                $lname = $datafile[1];
                $job = $datafile[2];
                $email = $datafile[3];
                $phone = $datafile[4];
                $address = $datafile[5];
                $skill = $datafile[6];
                $company = $datafile[7];
                $user = $datafile[8];
                $other = $datafile[9];
                $date = $datafile[10];

                if ($num != 1) {
                    mysql_query("INSERT INTO events(contact_fname,contact_lname,contact_job,contact_email,contact_phone"
                            . ",contact_address,contact_skill,company_name,user_id,other,contact_date)"
                            . "values('$fname','$lname','$job','$email','$phone','$address','$skill','$company','$user','$other','$date')");
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

        $lable = "Title;Date;Created\n";
        $result2 = mysql_query("select * from events");
        while ($data2 = mysql_fetch_assoc($result2)) {
            $datavalue .= $data2['title'] . ";" . $data2['date'] . ";" . $data2['created'] . "\n";
        }
        fputs($open_file, $lable . $datavalue);
        echo '<center><a  class="btn  btn-success btn-lg" href="' . $file . '">Download</a></center>';
        ?>
        <div class="box-body">
            <div style="margin-top: 50%" ></div>
        </div>
        <?php
    } else {
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
