<div class="box box-warning">
    <?php
    if (isset($msg) || isset($error)) {
        if ($msg == 1) {
            ?>
            <div class="box-body">
                <div class="alert alert-success h5" role="alert">تمت  بنجاح...</div>

            </div>
        <?php } else if ($msg == -1) { ?>
            <div class="box-body">
                <div class="alert alert-danger h4" role="alert"><strong>خطأ!</strong>..لم تتم .. <?php
                    if (isset($error)) {
                        echo $error;
                    }
                    ?></div>

            </div>           
        <?php } else if ($msg == -2) {
            ?>
            <div class="box-body">
                <div class="alert alert-danger h4" role="alert"><strong>خطا!</strong>..هذا الايميل بالفعل موجود..!! ?></div>

            </div> 
            <?php
        }
    }
    ?>
    <section class="content-header">
        <h1>
            احداث
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> الصفحه الرئيسيه</a></li>
            <li class="active">الاحداث</li>
            <li class="active">حدث</li>

        </ol>
    </section>
    <div class="row" >

        <?php
        if (isset($_GET['id']) && intval($_GET['id'])) {
            $data = EventModel::getAllDatabyid(intval($_GET['id']));
        } else {
            ?>
            <div class="box-body">
                <div class="alert alert-danger h4" role="alert"><strong>خطا!</strong>..يوجد شئ غير صحيح !! ..</div>
                <div style="margin-top: 60%"></div>
            </div>
            <?php
        }
        if (!empty($data)) {
            ?>
            <section class = "content">
                <div class = "row">
                    <div class = "col-md-12">
                        <div class = "box">
                            <div class = "box-header with-border">
                                <h3 class = "box-title">الحدث
                                </h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <?php if ($_SESSION['role'] != 'user') { ?>

                                            <th style="width: 40px">الحذف</th>
                                        <?php } ?>
                                        <th> الموظف</th>
                                        <th>تاريخ الانشاء</th>
                                        <th>التاريخ</th>
                                        <th>الحدث</th>
                                        <th style="width: 10px">#</th>

                                    </tr>
                                    <?php
                                    $i = 0;
                                    foreach ($data as $t) {
                                        ?>
                                        <tr>
                                            <?php if ($_SESSION['role'] != 'user') { ?>
                                                <td><a href="index.php?rt=Event/delete&id=<?= $t['id'] ?>"><span class="badge bg-red">Delete</span></a></td>

                                                <?php
                                            }
                                            if ($t['user_id'] != 0) {
                                                $user = UserModel::getAllDatabyid($t['user_id']);
                                                $username = $user[0]['user_name'];
                                            } else {
                                                $user = AccountModel::getAllDatabyid($t['acc_id']);
                                                $username = $user[0]['acc_name'];
                                            }
                                            ?>
                                            <td><?= $username ?></td>

                                            <td><?= $t['created'] ?></td>
                                            <td><?= $t['date'] ?></td>
                                            <td><?= $t['title'] ?></td>
                                            <td><?= ++$i ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </table>
                            </div>
                            <!-- /.box-body -->

                        </div>
                    </div>
                </div>
            </section>
        <?php } else { ?> 

            <div class="box-body">
                <div class="alert alert-danger h4" role="alert"><strong>خطا!</strong>..يوجد شئ غير صحيح !! ..</div>
                <div style="margin-top: 60%"></div>
            </div>
        <?php } ?>
        <div style="margin-top: 90%"></div>
    </div>
</div>




