<?php

$data = [
    'titlePage' => 'Chi tiết đơn hàng'
];

layout('header', 'admin', $data);

?>


<?php

layout('sidebar', 'admin', $data);

layout('breadcrumb', 'admin', $data);

view('detail_order', 'admin', 'cart');

?>


<?php

layout('footer', 'admin');


?>