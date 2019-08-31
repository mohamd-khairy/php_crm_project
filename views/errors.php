<div class="box box-warning">
    <div class="box-header with-border has-error">
        <h3 class="box-title" ></h3>

        <?php
        if (isset($msg)) {
            if ($msg == 1) {
                ?>
                <div class="alert alert-success h5" role="alert">Owner Added Successfully...</div>
            <?php } else if ($msg == -1) { ?>
                
                <div class="box-body">
                    <div class="alert alert-danger h4" role="alert"><strong>SORRY!</strong>..Some thing is Fault !! ..</div>
                    <div style="margin-top: 60%"></div>
                </div>

                <?php
            }
        }
        ?>
        <div style="margin-top: 50%"></div>
    </div>
</div>