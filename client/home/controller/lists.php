<?php


layout('header', 'client');

?>

<div class="container_my padding_X py-3">

    <?php

    $msg = getFlashData('msg');
    $type = getFlashData('type');

    getAlert($msg, $type);

    view('menu_banner', 'client');

    view('book_hot', 'client');

    view('course', 'client');

    view('blog', 'client');

    ?>

</div>

<?php

layout('footer', 'client');

?>