<?php

$data = [
    'titlePage' => 'Sửa người dùng'
];

layout('header', 'admin', $data);

?>


<?php

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);

view('fix_user', 'admin', 'user');

?>


<?php

layout('footer', 'admin');


?>