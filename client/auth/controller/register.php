<?php

$data = [
    'titlePage' => 'Đăng ký'
];

layout('header', 'client', $data);

view('register', 'client', 'auth');

layout('footer', 'client');


?>