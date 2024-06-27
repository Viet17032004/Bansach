
<?php

$data = [
    'titlePage' => 'Danh sách bình luận con khóa học'
];

layout('header', 'admin', $data);

?>


<?php

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);

view('children_course', 'admin', 'comment');

?>


<?php

layout('footer', 'admin');



?>


?>