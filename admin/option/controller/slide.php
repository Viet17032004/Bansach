<?php

$data = [
    'titlePage' => 'Slide'
];  

layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

view('slide', 'admin', 'option');

layout('footer', 'admin');

?>