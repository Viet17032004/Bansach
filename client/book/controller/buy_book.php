<?php

if(!isLogin()){
    setFlashData('msg', 'Vui lòng đăng nhập');
    setFlashData('type', 'danger');
    redirect("?module=book");
}

$data = [
    'titlePage' => 'Mua hàng'
];

layout('header', 'client', $data);

view('buy_book', 'client', 'book');

layout('footer', 'client');

?>

