<?php
include_once("config3.php");
if(array_key_exists('logout',$_GET))
{
	$facebook->destroySession();
	session_start();
	unset($_SESSION['userdata']);
        unset($_SESSION['facebook']);
	session_destroy();
	header("Location:index.php");
}
?>