<?php

$group_id = _MY_DATA['id_group'];

if(!checkPermission($group_id, 'user', 'approve_user')){
    redirect(_WEB_HOST_ERORR.'/permission.php');
}


$body = getRequest('get');

if(!empty($body['id'])){
    $id = $body['id'];
    $detailUser = getRow("SELECT * FROM user WHERE id='$id'");
    if(!empty($detailUser)){
        $status = $detailUser['status'];
        if(!empty($status)){
            if(update('user', ['status'=>0], "id='$id'")){
                setFlashData('msg', 'Cập nhập thông tin thành công');
                setFlashData('type', 'success');
            }else{
                setFlashData('msg', 'Lỗi hệ thống');
                setFlashData('type', 'danger');
            }
        }else{
            if(update('user', ['status'=>1], "id='$id'")){
                setFlashData('msg', 'Cập nhập thông tin thành công');
                setFlashData('type', 'success');
            }else{
                setFlashData('msg', 'Lỗi hệ thống');
                setFlashData('type', 'danger');
            }
        }
    }else{
        setFlashData('msg', 'url này không tồn tại');
        setFlashData('type', 'danger');
    }
}else{
    setFlashData('msg', 'url này lỗi');
    setFlashData('type', 'danger');
}

redirect($_SERVER['HTTP_REFERER']);

?>