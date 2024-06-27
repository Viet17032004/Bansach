
<?php

$data = [
    'titlePage' => 'Thêm người admin'
];

layout('header', 'admin', $data);

?>


<?php

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);

view('add_admin', 'admin', 'user');

?>


<?php

layout('footer', 'admin');


?>