<?php

$data = [
    'titlePage' => 'Thêm sách'
];

layout('header', 'admin', $data);

?>


<?php

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);

view('add', 'admin', 'book');

?>


<?php

layout('footer', 'admin');


?>