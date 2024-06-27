<?php

$data = [

    'titlePage' => 'Biểu đồ thống kê '
];
layout('header', 'admin', $data);
?>
<?php

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);

view('charts', 'admin', 'statistics');
?>
<?php

layout('footer', 'admin');
?>