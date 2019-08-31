<?php 
if(isset($_SESSION['acc_id'])  ){ 
?>

<div class="content-wrapper">
    <?php }?>

    <?php 
    require_once $this->view_folder . DS .$view.'.php';
    ?>
    <?php 
    if(isset($_SESSION['acc_id']) ){ 
    ?>
</div>
<?php } ?>