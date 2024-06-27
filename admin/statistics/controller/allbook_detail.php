<?php

$data = [

    'titlePage' => 'Bảng thống kê tất cả sản phẩm'
];
layout('header', 'admin', $data);
?>
<?php

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);

view('allbook_detail', 'admin', 'statistics');
?>
<?php
layout('footer', 'admin');
?>