<?php

$data = [
    'titlePage' => 'Footer'
];

layout('header', 'admin', $data);

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);

view('footer', 'admin', 'option');

layout('footer', 'admin');


?>