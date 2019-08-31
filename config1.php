<?php
session_start();
include_once("src/Google_Client.php");
include_once("src/contrib/Google_Oauth2Service.php");
######### edit details ##########
$clientId = '1054394732232-cebdescekl4qdvh128odsp28nlv1jmpn.apps.googleusercontent.com'; //Google CLIENT ID
$clientSecret = 'UIYnDHQ-7vxULU0Wtjhz-6aV'; //Google CLIENT SECRET
$redirectUrl = 'http://localhost/crm_company_ar/index2.php';  //return url (url to script)
$homeUrl = 'http://localhost/crm_company_ar/index2.php';  //return to home

##################################

$gClient = new Google_Client();
$gClient->setApplicationName('Login');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectUrl);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>