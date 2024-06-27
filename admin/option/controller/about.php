<?php

$data = [
    'titlePage' => 'Giới thiệu'
];

layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

view('about', 'admin', 'option');

layout('footer', 'admin');


?>