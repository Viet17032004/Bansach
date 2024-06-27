<?php

if(!isLogin()){
    setFlashData('msg', 'Vui lòng đăng nhập');
    setFlashData('type', 'danger');
    redirect(_WEB_HOST_ROOT);
}

layout('header', 'client');

?>

<div class="container_my padding_X py-3">

<div class="box_profile">



<?php

view('sidebar', 'client', 'profile');

view('detail_order', 'client', 'profile');

?>

</div>
</div>

<?php

layout('footer', 'client');

?>