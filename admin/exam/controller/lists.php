<?php

$data = [
    'titlePage' => 'Danh sách bài kiểm tra'
];

layout('header', 'admin', $data);

?>


<?php

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);

view('board', 'admin', 'exam');

?>


<?php

layout('footer', 'admin');


?>