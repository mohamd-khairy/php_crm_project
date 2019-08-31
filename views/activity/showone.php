

<section class="content-header">

    <h1>
        <i class="ion ion-clipboard"></i>Activity 
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Activity</li>
        <li class="active">show</li>
    </ol>
</section>
<?php
$dataa = ActivityModel::get_act_by_activity_id_desc(intval($_GET['act_id']))[0];
//print_r($dataa);
if(!empty($dataa)){
    //$dataa=$data[0];
?>

    <div class="box-body">  
       <section class="content">
        <div class="row">
        
            <div class="col-md-9">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                    <!-- timeline time label -->
                    <li class="time-label">
                        <span class="bg-red">
                            <?= $dataa['act_datetime'] ?>
                        </span>
                    </li>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <?php if($dataa['type']=='email'){ ?>
                    <li>
                        <i class="fa fa-envelope bg-blue"></i>

                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i></span>

                            <h3 class="timeline-header"><a href="#"><?= $dataa['user_name']?></a> Do operation on email</h3>

                            <div class="timeline-body">
                               <?= $dataa['act_details']?>
                            </div>
                            <div class="timeline-footer">
                                        <a class="btn btn-primary btn-xs" href="?rt=Activity/show">شاهد المزيد</a>
                                        <a class="btn btn-danger btn-xs"    href="?rt=Activity/delete&act_id=<?= $dataa['act_id'] ?>">احذف</a>
                                    </div>
                        </div>
                    </li>
                    <!-- END timeline item -->
                    <?php }elseif ($dataa['type']=='contact') {  ?>
                    <!-- timeline item -->
                    <li>
                        <i class="fa fa-user bg-aqua"></i>

                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> <?= date('A h:i D-m-Y',$dataa['act_datetime'])?></span>

                            <h3 class="timeline-header no-border"><a href="#"><?= $dataa['user_name']?></a> <?= $dataa['act_details']?>
                            </h3>
                             <div class="timeline-footer">
                                <a class="btn btn-primary btn-xs" href="?rt=Activity/show">شاهد المزيد</a>
                                <a class="btn btn-danger btn-xs"    href="?rt=Activity/delete&act_id=<?=$dataa['act_id']?>">احذف</a>
                            </div>
                        </div>
                    </li>
                    <!-- END timeline item -->
                    <?php }elseif($dataa['type']=='task'){?>
                    <!-- timeline item -->
                    <li>
                        <i class="fa fa-tasks bg-yellow"></i>

                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> <?=date('A h:i D-m-Y',$dataa['act_datetime'])?></span>

                            <h3 class="timeline-header"><a href="#"><?= $dataa['user_name']?></a>قام عمليه فالمهمات</h3>

                            <div class="timeline-body">
                              <?= $dataa['act_details']?>
                            </div>
                            <div class="timeline-footer">
                                <a class="btn btn-primary btn-xs" href="?rt=Activity/show">شاهد المزيد</a>
                                <a class="btn btn-danger btn-xs"    href="?rt=Activity/delete&act_id=<?=$dataa['act_id']?>">احذف</a>
                            </div>
                        </div>
                    </li>
                    <!-- END timeline item -->
                    <?php } else {  ?>
                    <!-- timeline item -->
                    <li>
                        <i class="fa fa-user bg-fuchsia"></i>

                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> <?= date('A h:i D-m-Y',$dataa['act_datetime'])?></span>

                            <h3 class="timeline-header no-border"><a href="#"><?= $dataa['user_name']?></a> <?= $dataa['act_details']?>
                            </h3>
                             <div class="timeline-footer">
                                <a class="btn btn-primary btn-xs" href="?rt=Activity/show">شاهد المزيد</a>
                                <?php if(isset($_SESSION['role']) && $_SESSION['role']=='manager'){?>
                                <a class="btn btn-danger btn-xs"    href="?rt=Activity/delete&act_id=<?=$dataa['act_id']?>">احذف</a>
                                <?php } ?>
                             </div>
                        </div>
                    </li>
                    <!-- END timeline item -->
                    <?php } ?>
                    <li>
                        <i class="fa fa-clock-o bg-gray"></i>
                    </li>
                </ul>
            </div>
          
        </div>
          </section>
           <div style="margin-top: 50% "></div>
    </div>
<?php } ?>