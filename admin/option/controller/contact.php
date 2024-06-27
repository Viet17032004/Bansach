<?php

$data = [
    'titlePage' => 'Liên hệ'
];

layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

view('contact', 'admin', 'option');

layout('footer', 'admin');


?>