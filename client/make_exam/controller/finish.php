<?php

if(!isLogin()){
    setFlashData('msg', 'Vui lòng đăng nhập');
    setFlashData('type', 'danger');
    redirect('?module=exam');
}

layout('header', 'client');

?>

<div class="container_my padding_X py-3">

<?php

view('finish', 'client', 'make_exam');

?>

</div>

<?php

layout('footer', 'client');

?>