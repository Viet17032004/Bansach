<?php

$data = [
    'titlePage' => 'Danh mục bài kiểm tra'
];

layout('header', 'admin', $data);

?>


<?php

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);

view('board', 'admin', 'exam_type');

?>


<?php

layout('footer', 'admin');


?>