<?php
define("HOME_PAGE", 'HomePage');
session_start();
error_reporting(0);
require_once './config.php';
router::loadcontroller();

?>