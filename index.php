<?php

session_start();
ob_start();

require './core/phpmailer/PHPMailer.php';
require './core/phpmailer/SMTP.php';
require './core/phpmailer/Exception.php';

require './config/config.php';
require './core/session.php';
require './core/connect.php';
require './core/database.php';
require './core/hepler.php';

require _WEB_PATH_ROOT."/config/config_vnpay.php";


$module = _MODULE_DEFAULT;
$action = _ACTION_DEFAULT;

if(!empty($_GET['module'])){
    $module = $_GET['module'];
}

if(!empty($_GET['action'])){
    $action = $_GET['action'];
}


$path = "client/$module/controller/$action.php";

if(file_exists($path)){
    require $path;
}else{
    require _PATH_ERORR_DEFAULT;
    die();
}




?>


