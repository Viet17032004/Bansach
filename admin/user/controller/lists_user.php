<?php

$data = [
    'titlePage' => 'Danh sách người dùng'
];

layout('header', 'admin', $data);

?>


<?php

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);

view('board_user', 'admin', 'user');

?>


<?php

layout('footer', 'admin');


?>