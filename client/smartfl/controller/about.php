<?php

$data = [
    'titlePage' => 'Giới thiệu'
];

layout('header', 'client', $data);

view('about', 'client', 'smartfl');

layout('footer', 'client');


?>
 