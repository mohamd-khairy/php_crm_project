<div class="box-body" id="d1">

</div>
    <?php
if (isset($msg) ) {
    if ($msg == 3) {
        ?>
        <div class="box-body">
            <div class="alert alert-warning h4" id="d2" role="alert"><strong>اكمل العمليه!</strong>.. أضف المكالمه ..!! ?></div>

        </div> 
        <?php
    }
}
?>

<section class="content-header">
    <h1>
        مكالمه جديده
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> الصفحه الرئيسيه</a></li>
        <li class="active">المكالمات</li>
        <li class="active">اضافه</li>
    </ol>
</section>
<div class="box-body">

    <div class="box box-warning" style="direction: rtl">
        <div class="box-header with-border has-error">
            <h3 class="box-title" style="margin-right: 70%">اضف مكالمه</h3>
        </div>

        <div class="box-body">
            <form id="myForm" method="get">

                <div class="form-group has-success" style="margin-left: 15%; margin-right: 25%">
                    <label class="control-label" for="inputError"><i class="fa fa-rss"></i> الموبايل:</label>
                    <input type="tel" name="call_number" id="t1" class="form-control"  placeholder="Enter ...">
                    <span class="help-block">ادخل رقم الموبايل ...</span>
                </div>


                <div class="form-group has-error" style="margin-left: 15%; margin-right: 25%">
                    <label class="control-label" for="inputError"><i class="fa fa-rss"></i> التفاصيل:</label>
                    <input type="text" name="call_title" id="t2" class="form-control"  placeholder="Enter ...">
                    <span class="help-block">ادخل تفاصيل المكالمه ...</span>
                </div>
                <center>
                    <div style="margin-left: 30%" >
                        <input  type="button"  value="اضـف" onclick="aa();"style="width: 150px" class="btn  btn-success btn-lg">
                        <button  type="reset" style="width: 150px"class="btn  btn-success btn-lg">امسح</button>
                    </div>
                </center>
            </form>
            <script  type="text/javascript">
                function aa() {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.open("GET", "?rt=Call/addotherajax&call_number="
                            + document.getElementById("t1").value + "&call_title="
                            + document.getElementById("t2").value, false);
                    xmlhttp.send(null);
                    document.getElementById('d1').innerHTML = xmlhttp.responseText;
                    var form = document.getElementById("myForm");
                    form.reset();
                    setTimeout(function () {
                         $('#d2').fadeOut('fast');
                    }, 3000);
                }
            </script>
            <div style="margin-top: 50%"></div>
        </div>
    </div>
</div>


<!-- /.box-body -->


