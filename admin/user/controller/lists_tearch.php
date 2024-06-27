<?php

$data = [
    'titlePage' => 'Danh sách giáo viên'
];

layout('header', 'admin', $data);

?>


<?php

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);

view('board_tearch', 'admin', 'user');

?>


<?php

layout('footer', 'admin');


?>