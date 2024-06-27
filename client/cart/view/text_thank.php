<?php

$msg = getFlashData('msg');
$type = getFlashData('type');

getAlert($msg, $type);

?>


<div class="w-100 pay_thank" style="height: 500px; background-image: url('<?php echo _WEB_HOST_IMAGE_CLIENT.'/pay_success.jpg'; ?>');">
    <h1>CẢM ƠN ĐÃ ỦNG HỘ SẢN PHẨM TẠI SMARTFL</h1>
</div>
