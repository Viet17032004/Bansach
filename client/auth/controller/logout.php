<?php

if(isLogin()){
    $user_id = isLogin()['user_id'];
    delete('login_token', "user_id='$user_id'");
    removeSession('loginToken');
}

setFlashData('msg', 'Đăng xuất thành công');
setFlashData('type', 'success');

redirect(_WEB_HOST_ROOT);

?>