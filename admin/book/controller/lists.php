<?php

$data = [
    'titlePage' => 'Danh sách sách'
];

layout('header', 'admin', $data);

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);
view('board', 'admin', 'book');


layout('footer', 'admin');


?>