<div class="box box-warning">
    <div class="box-header with-border has-error">
        <h3 class="box-title" style="margin-right: 70%">Add Owner</h3>
    </div>
    <?php
    if (isset($msg)) {
        if ($msg == 1) {
            ?>
            <div class="alert alert-success h5" role="alert">Owner Added Successfully...</div>
        <?php } else if ($msg == -1) { ?>
            <div class="box-body">
            <div class="alert alert-danger h4" role="alert"><strong>SORRY!</strong>..This page not Available for You ..</div>
           <div style="margin-top: 50%"></div>
            </div>
                <?php
        }
    }
    ?>
            
</div>