<?php

$data = [
    'titlePage' => 'Khóa học'
];

layout('header', 'admin', $data);

?>


<?php

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);

view('board', 'admin', 'course');

?>


<?php

layout('footer', 'admin');


?>