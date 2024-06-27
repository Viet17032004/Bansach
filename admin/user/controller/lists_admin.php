<?php

$data = [
    'titlePage' => 'Danh sách admin'
];

layout('header', 'admin', $data);

?>


<?php

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);

view('board_admin', 'admin', 'user');

?>


<?php

layout('footer', 'admin');


?>