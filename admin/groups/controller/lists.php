<?php

$id_group = _MY_DATA['id_group'];

if(empty(checkPermission($id_group, 'group', 'lists'))){
    redirect(_WEB_HOST_ERORR.'/permission.php');
}

$data = [
    'titlePage' => 'Cấp bậc'
];

layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

view('board', 'admin', 'groups');

layout('footer', 'admin');
die;
?>