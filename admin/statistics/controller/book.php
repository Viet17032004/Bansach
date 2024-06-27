<?php

$data = [

    'titlePage' => 'Thống kê danh mục sách'
];
layout('header', 'admin', $data);
?>
<?php

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);

view('book', 'admin', 'statistics');

?>
<?php
layout('footer', 'admin');
?>