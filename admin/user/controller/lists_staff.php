<?php

$data = [
    'titlePage' => 'Danh sách nhân viên'
];

layout('header', 'admin', $data);

?>


<?php

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);

view('board_staff', 'admin', 'user');

?>


<?php

layout('footer', 'admin');


?>