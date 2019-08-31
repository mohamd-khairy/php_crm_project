<div class="box-body">

    <section class="content-header">
        <h1>ارسال ايميل</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> الصفحه الرئيسيه</a></li>
            <li class="active">الايميلات</li>
        </ol>
    </section>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//code.jquery.com/jquery-1.9.1.js"></script>

    <script>
        var contacts = JSON.parse(localStorage.getItem('contact_id'));
        //alert(contacts);
        function submitForm() {
            var fd = new FormData(document.getElementById("fileinfo"));
            $.ajax({
                url: "?rt=Email/complete_sendajax",
                type: "POST",
                data: fd,
                processData: false, // tell jQuery not to process the data
                contentType: false   // tell jQuery not to set contentType
            }).done(function (data) {
                console.log("PHP Output:");
                console.log(data);
            });
            return false;
        }
        function post_to_url(path) {
            $("#spinner").show();
            method = "post"; // Set method to post by default, if not specified.
            var content = document.getElementById('content').value;
            var form = document.createElement("form");
            form.setAttribute("method", method);
            form.setAttribute("action", path);
            if ($('#content').val() == '') {
                alert(0);
            } else {
                params = {'contacts': contacts, 'email_content': content};
                for (var key in params) {
                    if (params.hasOwnProperty(key)) {
                        var hiddenField = document.createElement("input");
                        hiddenField.setAttribute("type", "hidden");
                        hiddenField.setAttribute("name", key);
                        hiddenField.setAttribute("value", params[key]);
                        form.appendChild(hiddenField);
                    }
                }
                document.body.appendChild(form);
                form.submit();
            }
        }
        //upload image ...


    </script>
    <div class="box-body">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">ارسل رساله جديده</h3>
                </div>
                <!-- /.box-header -->
                <form  method="post" enctype="multipart/form-data" id="fileinfo" name="fileinfo" >
                    <div class="box-body">

                        <div class="form-group">
                            <input class="form-control" type="text" name="email_content" id="content" placeholder="المحتوي:">
                        </div>
                        <div class="form-group">
                            <div class="btn btn-default btn-file">
                                <i class="fa fa-paperclip"></i> مرفق
                                <input type="file" name="file" id="image" required />
                            </div>
                            <p class="help-block">حد اقصي. 32ميجا</p>
                        </div>
                    </div>
                    
                     <!-- /.spinner loadin -->
                      <div id="spinner" style="display: none">
                        <img id="img-spinner" src="img/spinner.gif" alt="loading"/>
                    </div>
                    
                   
                    <div class="box-footer">

                        <div class="pull-right">

                            <button type="button" onclick="submitForm(), post_to_url('?rt=Email/complete_sendajax');" class="btn btn-primary"><i class="fa fa-envelope-o"></i> ارسل</button>
                        </div>
                        <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> امسح</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
                <div id="output"></div>
            </div>
            <!-- /. box -->
        </div>

        <!-- /.box-body -->
    </div>
    <div style="margin-top: 50%"></div>
</div>