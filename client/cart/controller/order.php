<?php

if(!isLogin()){
    setFlashData('msg', 'url này lỗi');
    setFlashData('type', 'danger');
    redirect(_WEB_HOST_ROOT);
}

$data = [
    'titlePage' => 'Đơn hàng'
];

layout('header', 'client', $data);

view('order', 'client', 'cart');

layout('footer', 'client');



?>