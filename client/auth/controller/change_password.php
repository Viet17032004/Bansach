<?php

$data = [
    'titlePage' => 'Đổi mật khẩu'
];

layout('header', 'client', $data);
 

view('change_password', 'client', 'auth');

layout('footer', 'client')


?>