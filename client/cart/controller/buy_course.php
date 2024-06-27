<?php

$data = [
    'Mua khóa học'
];

layout('header', 'client', $data);

?>

<div class="container_my padding_X py-3">

<?php

view('buy_course', 'client', 'cart');

?>

</div>

<?php

layout('footer', 'client');


?>