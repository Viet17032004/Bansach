<?php

$body = getRequest('get');

if(!empty($body['token'])){ 
    $token = $body['token'];
    
    $detailUser = getRow("SELECT * FROM user WHERE token='$token'");
    if(!empty($detailUser)){
        $id = $detailUser['id'];
        $dataUpdate = [
            'status' => 1,
            'token' => ''
        ];
        if(update('user', $dataUpdate, "id='$id'")){
            setFlashData('msg', 'Tài khoản đã được kích hoạt bạn có thể đăng nhập');
            setFlashData('type', 'success');
        }else{
            setFlashData('msg', 'Lỗi hệ thống');
            setFlashData('type', 'danger');
        }

    }else{
        setFlashData('msg', 'url này không tồn tại');
        setFlashData('type', 'danger');
    }
}else{
    setFlashData('msg', 'url này lỗi');
    setFlashData('type', 'danger');
}

redirect('?module=auth&action=login');

?>