<?php
include_once("inc/facebook.php"); //include facebook SDK
######### Facebook API Configuration ##########
$appId = '1133025083426080'; //Facebook App ID
$appSecret = 'c1de8a2bd482a0a925dba8e73066e8d8'; // Facebook App Secret
$homeurl = 'http://localhost/crm_company_ar/index3.php';  //return to home
$fbPermissions = 'email';  //Required facebook permissions

//Call Facebook API
$facebook = new Facebook(array(
  'appId'  => $appId,
  'secret' => $appSecret

));
$fbuser = $facebook->getUser();
?>