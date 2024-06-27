<?php

if(!isLogin()){
    setFlashData('msg', 'Vui lòng đăng nhập');
    setFlashData('type', 'danger');
    redirect(_WEB_HOST_ROOT);
}

layout('header', 'client');

?>

<div class="container_my padding_X py-3">




<?php

view('active_course', 'client', 'profile');

?>

</div>

<?php

layout('footer', 'client');

?>