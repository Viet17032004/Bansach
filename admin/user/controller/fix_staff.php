<?php

$data = [
    'titlePage' => 'Sửa nhân viên'
];

layout('header', 'admin', $data);

?>


<?php

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);

view('fix_staff', 'admin', 'user');

?>


<?php

layout('footer', 'admin');


?>