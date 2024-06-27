<?php

$data = [
    'titlePage' => 'Trang đăng nhập'
];

layout('header', 'client', $data);

view('login', 'client', 'auth');

layout('footer', 'client', $data);


?>