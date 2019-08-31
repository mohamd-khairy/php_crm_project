
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        الصفحه الرئيسيه
        <small>لوحه التحكم </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> الصفحه الرئيسيه</a></li>

    </ol>
</section>
<?php
$c = CompanyModel::getAllData_by_acc_id($_SESSION['acc_id']);
if (empty($c)) {
    ?>
    <div class="box-body">
        <div class="alert alert-danger h4" role="alert"><strong>!!أولا </strong>..أدخــل بيناتــات شركــتك </div>

    </div>           
<?php }
?>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?php
                        $data = UserModel::getAllData_by_acc_id($_SESSION['acc_id']);
                        echo count($data);
                        ?> </h3>

                    <p>الموظفين</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a type="button" href="index.php?rt=User/show" class="small-box-footer">شاهد المزيد <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3> <?php
                        $data = ContactModel::getAllData_by_acc_id($_SESSION['acc_id']);
                        echo count($data);
                        ?></h3>

                    <p>العملاء </p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-people-outline"></i>
                </div>

                <a href="index.php?rt=Contact/show" class="small-box-footer">شاهد المزيد <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->

            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?php
                        $data = DealModel::getAllData_by_acc_id($_SESSION['acc_id']);
                        echo count($data);
                        ?></h3>

                    <p>الصفقات </p>
                </div>
                <div class="icon">
                    <i class="ion ion-clipboard"></i>
                </div>
                <a href="index.php?rt=Deal/show" class="small-box-footer">شاهد المزيد <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3><?php
                        $datacompany = CompanyModel::getAllData_by_acc_id($_SESSION['acc_id']);
                        echo count($datacompany);
                        ?> </h3>

                    <p> الشركات </p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="index.php?rt=Company/show" class="small-box-footer">شاهد المزيد <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>

                <div style="margin-top: 2%"></div>

    
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
            <div class="box box-solid bg-light-blue-gradient">
                <div class="box-header">
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip" title="Date range">
                            <i class="fa fa-calendar"></i></button>
                        <button type="button" class="btn btn-primary btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
                            <i class="fa fa-minus"></i></button>
                    </div>
                    <!-- /. tools -->

                    <i class="fa fa-map-marker"></i>

                    <h3 class="box-title">
                        العالم
                    </h3>
                </div>
                <div class="box-body">
                    <div id="world-map" style="height: 250px; width: 100%;"></div>
                </div>

                <!-- /.box-body-->
                <div class="box-footer no-border">

                    <div class="row">
                        <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                            <div id="sparkline-1"></div>
                            <div class="knob-label">الزائرين</div>
                        </div>
                        <!-- ./col -->
                        <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                            <div id="sparkline-2"></div>
                            <div class="knob-label">اونلاين</div>
                        </div>
                        <!-- ./col -->
                        <div class="col-xs-4 text-center">
                            <div id="sparkline-3"></div>
                            <div class="knob-label">المغادرين</div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>




        </section>


    </div >
    <!--
        <style type="text/css">
            .fleft{float: left;}
            .post_social {margin: 0 0 10px;height: 35px;}
            .post_social img{float:left;margin-right:  75px;margin-bottom: 5%}
            .post_row img {float: left;overflow: hidden;width: 200px;margin-right: 15px;margin-bottom: 8px;}
            .post_row p {font-size: 16px !important;}
        </style>
        <div class="form-group">
            <div class="fleft">    
                <div class="post_social">
                    <a href="javascript:void(0)" class="icon-fb" onclick="javascript:genericSocialShare('http://www.facebook.com/sharer.php?u=https://www.facebook.com/ABSLEARN/?fref=ts')" title="Facebook Share"><img src="img/fb.png"/></a>
                    <a href="javascript:void(0)" onclick="javascript:genericSocialShare('https://plus.google.com/share?url=http%3A%2F%2Fwww.codexworld.com%2Fsocial-popup-page-scroll-using-jquery-css%2F')" class="icon-gplus" title="Google Plus Share"><img src="img/gp.png"/></a>
                    <a href="javascript:void(0)" class="icon-tw" onclick="javascript:genericSocialShare('http://twitter.com/share?text=Social popup on page scroll using jQuery and CSS&amp;url=http://www.codexworld.com/social-popup-page-scroll-using-jquery-css/')" title="Twitter Share"><img src="img/tw.png"/></a>
                    <a href="javascript:void(0)" class="icon-linked_in" onclick="javascript:genericSocialShare('http://www.linkedin.com/shareArticle?mini=true&amp;url=http%3A%2F%2Fwww.codexworld.com%2Fsocial-popup-page-scroll-using-jquery-css%2F')" title="LinkedIn Share"><img src="img/in.png"/></a>
                    <a href="javascript:void(0)" class="icon-linked_in" onclick="javascript:genericSocialShare('http://pinterest.com/pin/create/button/?url=http%3A%2F%2Fwww.codexworld.com%2Fsocial-popup-page-scroll-using-jquery-css%2F&media={http%3A%2F%2Fwww.codexworld.com%2Fwp-content%2Fuploads%2F2014%2F11%2Fsocial-buttons-jquery-popup-dialog-codexworld.png}')" title="Pinterest Share"><img src="img/pin.png"/></a>
                    <a href="javascript:void(0)" class="icon-linked_in" onclick="javascript:genericSocialShare('http://www.stumbleupon.com/badge/?url=http://www.codexworld.com/social-popup-page-scroll-using-jquery-css/')" title="StumbleUpon Share"><img src="img/su.png"/></a>
                    <a href="javascript:void(0)" class="icon-linked_in" onclick="javascript:genericSocialShare('http://www.reddit.com/submit?url=http%3A%2F%2Fwww.codexworld.com%2Fsocial-popup-page-scroll-using-jquery-css%2F')" title="Reddit Share"><img src="img/rt.png"/></a>
                    <a href="javascript:void(0)" class="icon-linked_in" onclick="javascript:genericSocialShare('mailto:?subject=I wanted you to see this site&amp;body=Check out this site http://www.codexworld.com/social-popup-page-scroll-using-jquery-css/.')" title="E-Mail Share"><img src="img/mail.png"/></a>
                </div>
                <script type="text/javascript" async >
                    function genericSocialShare(url) {
                        window.open(url, 'sharer', 'toolbar=0,status=0,width=648,height=395');
                        return true;
                    }
                </script>
            </div>
    <!-- Main row 
    -->
    <div style="margin-top: 6%"></div>
    
    
</section>
