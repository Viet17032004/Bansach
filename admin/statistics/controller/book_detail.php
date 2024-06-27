<?php

$data = [

    'titlePage' => 'Chi tiết danh mục sách'
];
layout('header', 'admin', $data);
?>
<?php

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);

view('book_detail', 'admin', 'statistics');
?>
<?php
layout('footer', 'admin');
?>