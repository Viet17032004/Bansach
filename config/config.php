<?php

date_default_timezone_set('Asia/Ho_Chi_Minh');

define('_PAGE', 5);

const _MODULE_DEFAULT = 'home'; 
const _ACTION_DEFAULT = 'lists'; 

const _MODULE_DEFAULT_ADMIN = 'dashboard';
const _ACTION_DEFAULT_ADMIN = 'lists'; 

define('_WEB_HOST_ROOT', 'http://'.$_SERVER['HTTP_HOST'].'/-project_1');
define('_WEB_HOST_ROOT_ADMIN', 'http://'.$_SERVER['HTTP_HOST'].'/-project_1/admin');

define('_WEB_HOST_ERORR', _WEB_HOST_ROOT.'/public/error');

define('_WEB_PATH_ROOT', str_replace('\config', '', __DIR__));

define('_WEB_HOST_TEMPLATE', _WEB_HOST_ROOT.'/public');
define('_WEB_PATH_TEMPLATE', _WEB_PATH_ROOT.'/public');

define('_WEB_PATH_ERORR', _WEB_PATH_ROOT.'/public/error');

define('_WEB_HOST_TEMPLATE_ADMIN', _WEB_HOST_TEMPLATE.'/admin');
define('_WEB_PATH_TEMPLATE_ADMIN', _WEB_PATH_TEMPLATE.'/admin');

const _PATH_ERORR_DEFAULT = _WEB_PATH_TEMPLATE.'/error/404.php';

define('_WEB_HOST_IMAGE_CLIENT', _WEB_HOST_TEMPLATE.'/client/assets/image');
define('_WEB_PATH_IMAGE_CLIENT', _WEB_PATH_TEMPLATE.'/client/assets/image');

// define('_WEB_HOST_ROOT_ADMIN', _WEB_HOST_ROOT.'/admin');

const _HOST = 'localhost';
const _USER = 'root';
const _PASS = '';
const _DB = 'project_1';
const _DRIVER = 'mysql';





?>