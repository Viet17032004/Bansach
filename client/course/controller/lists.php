<?php


layout('header', 'client');

?>

<div class="container_my padding_X py-3">

<?php

$msg = getFlashData('msg');
$type = getFlashData('type');

getAlert($msg, $type);

view('lists', 'client', 'course');


?>

</div>

<?php

layout('footer', 'client');

?>