<?php
include_once("config1.php");
if(array_key_exists('logout',$_GET))
{
	unset($_SESSION['token']);
	unset($_SESSION['google_data']); //Google session data unset
	$gClient->revokeToken();
	session_destroy();
         session_start();
                $_SESSION['msg'] = -1;
	header("Location:index.php");
}
?>