<?php

$data = [
    'titlePage' => 'Danh mục khóa học'
];

layout('header', 'admin', $data);

?>


<?php

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);

view('board', 'admin', 'course_type');

?>


<?php

layout('footer', 'admin');


?>