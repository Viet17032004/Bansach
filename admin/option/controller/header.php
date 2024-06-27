<?php

$data = [
    'titlePage' => 'Header'
];

layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

view('header', 'admin', 'option');

layout('footer', 'admin');



?>