<?php

$data = [
    'titlePage' => 'Thêm bài kiểm tra'
];

layout('header', 'admin', $data);

?>


<?php

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);

view('add', 'admin', 'exam');

?>


<?php

layout('footer', 'admin');


?>