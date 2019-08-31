<div class="box-body" id="d1">
    
</div>
<section class="content-header">
    <h1>
        الاحداث والتقويم
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> الصفحه الرئيسيه</a></li>
        <?php if (isset($_GET['c'])) { ?>
            <li class="active">التقويم</li>
        <?php } else { ?>
            <li class="active">الاحداث</li>
        <?php } ?>
    </ol>
</section>

<div  class="box-body">

    <div class="row-border">

        <div class="box box-solid bg-green-gradient">
            <div class="box-header">
                <?php if (isset($_GET['c'])) { ?>
                    <i class="fa fa-calendar"></i>

                    <h3 class="box-title">التقويم</h3>
                    <!-- tools box -->
                <?php } else { ?>
                    <i class="fa fa-tablet"></i>

                    <h3 class="box-title">الاحداث</h3>
                <?php } ?>
                <div class="pull-right box-tools">
                    <!-- button with a dropdown -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bars"></i></button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href="<?= HostName ?>index1.php">اضافه حدث جديد</a></li>
                            <li><a href="index.php?rt=Event/show">كل الاحداث</a></li>
                            <li class="divider"></li>
                            <li><a href="index.php?rt=Event/show&c" >التقويــم</a></li>
                        </ul>
                    </div>
                    <button type="button"  class="btn btn-success btn-sm " data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
                <!-- /. tools -->
            </div>
            <?php if (isset($_GET['c'])) { ?>
                <!-- /.box-header -->
                <div  id="m" class="box-body no-padding">
                    <!--The calendar -->
                    <div id="calendar" style="width: 100%"></div>
                </div>
                <!-- /.box-body -->
                <?php
            } else {

                $data = EventModel::getAll($offset);
                ?>

                <div class="box-footer text-black">
                    <div class="row"  >
                        <div class="col-sm-12">

                            <!-- Progress bars -->

                            <!-- /.box-header -->
                            <div class="box-body">
                                <ul class="todo-list">
                                    <?php
                                    $i = 1;
                                    foreach ($data as $event) {
                                        if ($event['acc_id'] == $_SESSION['acc_id']) {
                                            ?>
                                            <li>
                                                <small><span> <?= $i++ ?> </span></small>
                                                <!-- drag handle -->
                                                <span class="handle">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </span>
                                                <!-- checkbox -->
                                                <!-- todo text -->
                                                <span class="text"><?= $event['title'] ?> </span>
                                                <small class="label label-success"><span class="text"><?= $event['company'] ?> </span></small>
                                                <!-- Emphasis label -->
                                                <small class="label label-danger"><i class="fa fa-clock-o"></i> <?= $event['date'] ?></small>
                                                <!-- General tools such as edit or delete-->
                                                <div class="tools" class="pull-left">
                                                    <a href="?rt=Event/showone&id=<?= $event['id'] ?>">     <i class="fa fa-table"></i></a>
                                                    <?php if ($_SESSION['role'] != 'user') { ?>

                                                    <button type="button" onclick="aa(<?= $event['id'] ?>);">  <i class="fa fa-trash-o"></i> </button>
                                                    <?php } ?>
                                                </div>
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                            
                        
                            <div class="box-header">
                                <div class="pull-left">
                                    <div class="btn-group">

                                        <div class="box-tools pull-left">
                                            <ul class="pagination pagination-sm inline">
                                                <li><a href="#">&laquo;</a></li>
                                                <?php
                                                for ($i = 1; $i <= $count; $i++) {
                                                    $current = ($i - 1) * PER_PAGE_COUNT;
                                                    ?>
                                                    <li><a href="index.php?rt=Event/show&pg=<?= $current ?>"><?= $i ?></a></li>
                                                <?php } ?>

                                                <li><a href="#">&raquo;</a></li>
                                            </ul>
                                        </div> 
                                        <!-- /.btn-group -->
                                    </div>

                                </div>
                                <div class="pull-right">
                                    <div class="box-footer clearfix no-border">
                                        <button type="button" onclick="DeleteAll();" class="btn btn-danger pull-right"><i class="fa fa-plus"></i> حذف الكل</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->


                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            <?php } ?>
        </div>
<script  type="text/javascript">
                            function aa(a) {
                                var xmlhttp = new XMLHttpRequest();
                                var id=a;
                                xmlhttp.open("GET", "?rt=Event/delete&id="+id, false);
                                xmlhttp.send(null);
                                document.getElementById('d1').innerHTML = xmlhttp.responseText;
                                var btn = event.target;
                                $(btn).closest("li").remove();

                            }
                              function DeleteAll() {

                                var xmlhttp = new XMLHttpRequest();
                                xmlhttp.open("GET", "?rt=Event/delete_all", false);
                                xmlhttp.send(null);
                                document.getElementById('d1').innerHTML = xmlhttp.responseText;
                                $("ul").children().remove();
                            }
                        </script>
    </div>
    <div style="margin-top: 50%"></div>
</div>