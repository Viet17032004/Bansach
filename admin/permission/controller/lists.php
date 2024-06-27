<?php

$body = getRequest('get');

if(!empty($body['id'])){
    $id = $body['id'];
    $group = getRow("SELECT * FROM groups WHERE id='$id'");
    if(!empty($group)){
        $data = [
            'titlePage' => 'Phân quyền - '.$group['name']
        ]; 
    }else{
        setFlashData('msg', "url này không tồi tại !!!");
        setFlashData('type', "danger");
        redirect(_WEB_HOST_ROOT_ADMIN);  
    }
}else{
    setFlashData('msg', "url này lỗi !!!");
    setFlashData('type', "danger");
    redirect(_WEB_HOST_ROOT_ADMIN);
}

 

layout('header', 'admin', $data);

layout('sidebar', 'admin', $data); 

layout('breadcrumb', 'admin', $data);

view("permission", 'admin', 'permission');

layout('footer', 'admin');




?>