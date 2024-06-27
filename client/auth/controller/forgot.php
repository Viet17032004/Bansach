<?php

$data = [
    'titlePage' => 'Đổi mật khẩu'
];

layout('header', 'client', $data);


view('forgot', 'client', 'auth');

layout('footer', 'client')


?>