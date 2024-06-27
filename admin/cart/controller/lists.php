<?php

$data = [
    'titlePage' => "Đơn hàng"
];

layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

view('board', 'admin', 'cart');

layout('footer', 'admin');

?>