<?php

$data = [
    'titlePage' => 'Thêm khóa học'
];

layout('header', 'admin', $data);

?>


<?php

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);

view('add', 'admin', 'course');

?>


<?php

layout('footer', 'admin');


?>