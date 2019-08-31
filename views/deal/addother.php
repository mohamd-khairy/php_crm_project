<div class="box-body">
    <div id="d1"></div>

    <section class="content-header" style="margin-top: -1%;margin-bottom: 5%">
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> الصفحه الرئيسيه</a></li>
            <li class="active">الصفقات</li>
            <li class="active">اضافه</li>
        </ol>

    </section>


    <!-- TABLE: LATEST ORDERS -->
    <div style="margin-top: -2%" class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">اضافه صفقه</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="direction: rtl">
            <div class="table-responsive">
                <form id="myForm" method="get" >
                    <!-- text input -->
                    <div class="form-group has-error" style="margin-left: 15%; margin-right: 25%">
                        <label class="control-label" for="inputSuccess"><i class="fa fa-user"></i> الطرف الاول:</label>
                        <input type="text" name="deal_user" class="form-control" id="t1" placeholder="ادخل ...">
                        <span class="help-block">ادخل اسم العميل  ...</span>
                    </div>

                    <!-- input states -->
                    <div class="form-group has-success" style="margin-left: 15%; margin-right: 25%">
                        <label class="control-label" for="inputSuccess"><i class="fa fa-pencil"></i> محتوي الصفقه:</label>
                        <input type="text" name="deal_name" class="form-control" id="t2" placeholder="ادخل ...">
                        <span class="help-block">ادخل محتوي الصفقه  ...</span>
                    </div>

                    <div class="form-group has-warning" style="margin-left: 15%; margin-right: 25%">
                        <label class="control-label" for="inputSuccess"><i class="fa fa-money"></i> القيمه:</label>
                        <input type="text" name="deal_value" class="form-control" id="t3" placeholder="ادخل ...">
                        <span class="help-block">ادخل قيمه الصفقه  ...</span>
                    </div>

                    <div class="form-group has-error" style="margin-left: 15%; margin-right: 25%">
                        <label class="control-label" for="inputAddress"><i class="fa fa-times"></i> تاريخ البدايه:</label>
                        <input type="date" name="deal_start_date" class="form-control" id="t4" placeholder="ادخل ...">
                        <span class="help-block"> ادخل تاريخ بدايه الصفقه ...</span>
                    </div>
                    <div class="form-group has-success" style="margin-left: 15%; margin-right: 25%">
                        <label class="control-label" for="inputAddress"><i class="fa fa-times"></i> تاريخ الانتهاء:</label>
                        <input type="date" name="deal_end_date" class="form-control" id="t5" placeholder="ادخل ...">
                        <span class="help-block">تاريخ انتهاء الصفقه  ...</span>
                    </div>



                    <div class="form-group has-warning" style="margin-left: 15%; margin-right: 25%">
                        <label class="control-label" for="inputSuccess"><i class="fa fa-info"></i> معلومات اخري:</label>
                        <input type="text" name="other" class="form-control" id="t6" placeholder="ادخل ...">
                        <span class="help-block">معلومات اخري عن الصفقه ...</span>
                    </div>
                    <center>
                    <div style="margin-left: 30%" >
                        <input  type="button"  onclick="aa();" value="اضف" style="width: 150px" class="btn  btn-success btn-lg">
                        <button  type="reset" style="width: 150px"class="btn  btn-success btn-lg">امسح</button>
                    </div>
                    </center>
                </form>
                    <script  type="text/javascript">
                    function aa() {
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.open("GET", "?rt=Deal/addotherajax&deal_user="
                                + document.getElementById("t1").value + "&deal_name="
                                + document.getElementById("t2").value + "&deal_value="
                                + document.getElementById("t3").value + "&deal_start_date="
                                + document.getElementById("t4").value + "&deal_end_date="
                                + document.getElementById("t5").value + "&other="
                                + document.getElementById("t6").value , false);
                        xmlhttp.send(null);
                        document.getElementById('d1').innerHTML = xmlhttp.responseText;
                        var form = document.getElementById("myForm");
                        form.reset();
//                        setTimeout(function () {
//                            $('#d2').fadeOut('fast');
//                        }, 3000);
                    }
                </script>
            </div>
            <!-- /.box-body -->
        </div>
        <div style="margin-top: 30%"></div>

    </div>

</div>