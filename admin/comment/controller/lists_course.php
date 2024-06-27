<?php

$data = [
    'titlePage' => 'Danh sách bình luận khóa học'
];

layout('header', 'admin', $data);

?>


<?php

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);

view('board_course', 'admin', 'comment');

?>


<?php

layout('footer', 'admin');



?>