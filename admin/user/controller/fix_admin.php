<?php

$data = [
    'titlePage' => 'Sửa admin'
];

layout('header', 'admin', $data);

?>


<?php

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);

view('fix_admin', 'admin', 'user');

?>


<?php

layout('footer', 'admin');


?>