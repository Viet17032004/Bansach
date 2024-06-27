<?php

$data = [
    'title' => 'Chi tiết bài viết'
];

layout('header', 'client', $data);

view('detail_blog', 'client', 'blog');

layout('footer', 'client');

?>