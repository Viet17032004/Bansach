<?php

$data = [
    'titlePage' => 'Thông tin tài khoản'
];

layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

view('lists', 'admin', 'profile');

layout('footer', 'admin');

?>