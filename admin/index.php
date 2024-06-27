<?php
session_start();
ob_start();

require '../core/phpmailer/PHPMailer.php';
require '../core/phpmailer/SMTP.php';
require '../core/phpmailer/Exception.php';

require '../config/config.php';
require '../core/session.php';
require '../core/connect.php';
require '../core/database.php';
require '../core/hepler.php';

$module = _MODULE_DEFAULT_ADMIN;
$action = _ACTION_DEFAULT_ADMIN;

if(!empty($_GET['module'])){
    $module = $_GET['module'];
}

if(!empty($_GET['action'])){
    $action = $_GET['action'];
}

$path = _WEB_PATH_ROOT."/admin/$module/controller/$action.php";

if(!isLogin()){
    setFlashData('msg', 'Vui lòng đăng nhập tài khoản trang quản trị');
    setFlashData('type', 'danger');
    redirect(_WEB_HOST_ROOT);
}else{
    $user_id = isLogin()['user_id'];
    $detailUser = getRow("SELECT * FROM user WHERE id='$user_id'");
    if($detailUser['id_group'] == 4){
        require _WEB_PATH_ERORR.'/permission.php';
        die;
    }else{
        define('_MY_DATA', $detailUser);
    }
}

if(file_exists($path)){
    require $path;
}else{
    require _PATH_ERORR_DEFAULT;
    die();
}





?>