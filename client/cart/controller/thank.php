<?php

$data = [
    'titlePage' => 'Cảm ơn'
];

layout('header', 'client', $data);

view('thank', 'client', 'cart');

layout('footer', 'client');


?>